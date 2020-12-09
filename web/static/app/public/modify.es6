$(function () {
    (function () {
        let formGroups = $('.form-group.required');
        $.each(formGroups, function (i, n) {
            let label = $(n).find('label.control-label:eq(0)');
            if (label) {
                label.html(label.html() + "<span class=\"require\">*</span>");
            }
        });
    })();

    (function () {
        var jsonEditor = $('.json-editor');
        var editor = [];
        var options = {
            mode: 'code',
            modes: ['code', 'tree'],
            onChange: function () {
                if (jsonEditor.length == editor.length) {
                    for (var index in editor) {
                        var json = editor[index].get();
                        $(jsonEditor[index]).next('div.form-group').find('input:eq(0)').val(JSON.stringify(json));
                    }
                }
            }
        };
        $.each(jsonEditor, function (i, n) {
            editor[i] = new JSONEditor($(n)[0], options);
            // var json = $(n).next('div.form-group').find('input:eq(0)').val();
            let input = $(n).next('div.form-group').find('input:eq(0)');
            editor[i].aceEditor.id = input.attr('id');
            editor[i].set(JSON.parse(input.val()));
        });
        pagesConfig.jsonEditor = editor;
    })();
    $('.selectpicker').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });
    $('.field-datetime').datetimepicker({
        autoclose: 1,
        format: 'yyyy-mm-dd hh:ii:ss',
    });

    // $('.datetimepicker-disable-date-1').datetimepicker({
    //     pickDate: false
    // });
    // $('.datetimepicker-disable-time-1').datetimepicker({
    //     pickTime: false
    // });

    $('.resetForm').click(function () {
        document.getElementById("dataForm").reset();
    });
    $('.goBack').click(function () {
        window.history.go(-1);
    });
    $('#dataForm').submit(function () {
        $.ajax({
            type: pagesConfig.submitType,
            url: pagesConfig.baseUrl,
            data: $('#dataForm').serialize(),
            dataType: 'json',
            success: function (result) {
                if (result.code != 0) {
                    toastr["error"](result.message, "提示");
                } else {
                    if (pagesConfig.modifySuccess) {
                        pagesConfig.modifySuccess(result, function () {
                            toastr["success"]("操作成功!", "提示");
                            window.location.href = pagesConfig.manageUrl;
                        });
                    } else {
                        toastr["success"]("操作成功!", "提示");
                        window.location.href = pagesConfig.manageUrl;
                    }
                }
            }
        });
        return false;
    });

    $('.images-upload-btn').fileupload({
        url: pagesConfig.uploadImageUrl,
        dataType: 'json',
        formData: {
            '_csrf': $('[name="_csrf"]').val()
        },
        submit: function (e, data) {
            var $input = $(e.target);
            $input.prev('span').html('上传中...');
        },
        always: function (e, data) {
            var $input = $(e.target);
            $input.prev('span').html('上传');
        },
        done: function (e, data) {
            if (data.result.code == 0) {
                var $input = $(e.target).next();
                var $showBtn = $input.parent('span').next();
                let imgUrl = data.result.content.imgUrl;
                $input.val(imgUrl);
                $showBtn.removeClass('hide').attr('href', imgUrl);
                let $delBtn = $input.parent('span').siblings('.delfile-btn');
                $delBtn.removeClass('hide');
            } else {
                toastr["error"](data.result.message, "提示");
            }
        },
        progressall: function (e, data) {
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('.file-upload-btn').fileupload({
        url: pagesConfig.uploadFileUrl,
        maxChunkSize: 5000000,  // 5MB 5000000
        dataType: 'json',
        formData: {
            '_csrf': $('[name="_csrf"]').val(),
        },
        submit: function (e, data) {
            var $input = $(e.target);
            $input.prev('span').html('上传中...');
        },
        always: function (e, data) {
            var $input = $(e.target);
            $input.prev('span').html('上传');
        },
        done: function (e, data) {
            if (data.result.code == 0) {
                var $input = $(e.target).next();
                var $showBtn = $input.parent('span').next();
                let fileUrl = data.result.content.fileUrl;
                $input.val(fileUrl);
                $showBtn.removeClass('hide').attr('href', fileUrl);
                let $delBtn = $input.parent('span').siblings('.delfile-btn');
                $delBtn.removeClass('hide');
            } else {
                toastr["error"](data.result.message, "提示");
            }
        },
        progressall: function (e, data) {
            let progress = parseInt(data.loaded / data.total * 100, 10);
            let $input = $(e.target);
            $input.prev('span').html('上传中(' + progress + '%)...');
            console.log(progress);
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');


    // $(function () {
    //     'use strict';
    //     // Change this to the location of your server-side upload handler:
    //     var url = window.location.hostname === 'blueimp.github.io' ?
    //         '//jquery-file-upload.appspot.com/' : 'server/php/';
    //     $('#fileupload').fileupload({
    //         url: url,
    //         dataType: 'json',
    //         done: function (e, data) {
    //             $.each(data.result.files, function (index, file) {
    //                 $('<p/>').text(file.name).appendTo('#files');
    //             });
    //         },
    //         progressall: function (e, data) {
    //             var progress = parseInt(data.loaded / data.total * 100, 10);
    //             $('#progress .progress-bar').css(
    //                 'width',
    //                 progress + '%'
    //             );
    //         }
    //     }).prop('disabled', !$.support.fileInput)
    //         .parent().addClass($.support.fileInput ? undefined : 'disabled');
    // });

    $('.delfile-btn').click(function () {
        let fileId = $(this).attr('data-id');
        let input = $('#' + fileId);
        let inputShowBtn = $('#' + fileId + '-show');
        $(this).addClass('hide');
        input && input.val('');
        inputShowBtn && inputShowBtn.addClass('hide').attr('href', '');
        toastr["info"]('不要忘记提交表单哦 ^_^', "提示");
    });

    // 依赖关系 radio
    let depednRadio = $('[depend-radio="true"] input[type="radio"]:not(".switch")');
    depednRadio.on('ifChecked', function (event) {
        let dependRow = $(event.target).parents('.form-group').find('[depend-radio="true"]');
        let dependField = dependRow.attr('depend');
        let dependValue = event.target.value;
        console.log(dependField, dependValue);
        if (dependField && dependValue) {
            // 根据依赖字段隐藏所有相关 dom，排除当前值的 dom
            let fieldGroups = $('[depend-for="' + dependField + '"]');
            $.each(fieldGroups, function (i, n) {
                let fieldGroup = $(n).parent().parent();
                if ($(n).attr('depend-val') == dependValue) {
                    fieldGroup.show();
                } else {
                    fieldGroup.hide();
                }
            });
        }
    });


    // 依赖关系 redio 初始化
    !(function () {
        let depednRadio = $('[depend-radio="true"]');
        $.each(depednRadio, function (i, radio) {
            let dependField = $(radio).attr('depend');
            let masterInput = $(radio).prev('input[type="hidden"]');

            console.log(masterInput);


            if (masterInput) {
                $("input[name='" + masterInput.attr('name') + "']:radio").each(function () {
                    if ($(this).is(':checked') == true) {
                        let dependValue = $(this).val();
                        if (dependField && dependValue) {

                            // 根据依赖字段隐藏所有相关 dom，排除当前值的 dom
                            let fieldGroups = $('[depend-for="' + dependField + '"]');
                            $.each(fieldGroups, function (i, n) {
                                let fieldGroup = $(n).parent().parent();
                                if ($(n).attr('depend-val') == dependValue) {
                                    fieldGroup.show();
                                } else {
                                    fieldGroup.hide();
                                }
                            });

                            // console.log(dependField, dependValue);

                        }
                    }
                });


                // radio
                // $("input[name='id']:checkbox").each(function () {
                //     if (true == $(this).is(':checked')) {
                //         str += $(this).val() + ",";
                //     }
                // });

                // let dependValue = $(n).val();
                // if (dependField && dependValue) {
                //     console.log(dependField, dependValue);
                // }
            }
            // let dependValue = $(n).attr('');
            // console.log(n);
        });
    })();


});


