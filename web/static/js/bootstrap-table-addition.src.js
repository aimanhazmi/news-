/**
 * Created by lilei on 2017/8/25.
 * BTable 扩展对象
 * 必须传入 jquery 对象, 否则内部不可以用
 *
 * toastr 资料 http://codeseven.github.io/toastr/demo.html
 * bootstrap3-dialog 资料 https://nakupanda.github.io/bootstrap3-dialog/
 * */


var BTable = function ($) {
    "use strict";
    return {
        /**
         * 在加载请求数据前,预处理数据
         * */
        responseHandler: function (ret) {
            if (ret.code == 0) {
                return ret.content;
            }
            return [];
        },
        sortFormatter: function (value, row, index) {
            if (this.groupBtn) {
                var groupBtn = this.groupBtn.split(',');
                var btns = [];
                var dataUrl = BTable.config.baseUrl +'/'+ row.id;
                btns['sort'] = "<a href='javascript:void(0);' class='btn btn-green btn-xs mbs sort-act up' data-url='"+dataUrl+"'><i class='fa fa-arrow-up'></i><\/a>";
                btns['sort'] += "<a href='javascript:void(0);' class='btn btn-warning btn-xs mbs sort-act down' data-url='"+dataUrl+"'><i class='fa fa-arrow-down'></i><\/a>";
                var html = [];
                groupBtn.forEach(function (i) {
                    if (btns[i]) {
                        html.push(btns[i]);
                    }
                });
                return html.join('');
            }
            return '未定义按钮';
        },
        /**
         * 添加操作按钮
         * */
        operateFormatter: function (value, row, index) {
            if (this.groupBtn) {
                var groupBtn = this.groupBtn.split(',');
                var btns = [];
                var status_btn_class = row._status_btn == '启用' ? 'fa fa-check-circle' : 'fa fa-ban';
                btns['edit'] = "<a href='javascript:void(0);' class='btn btn-green btn-xs mbs edit-act'><i class='fa fa-edit'></i>编辑<\/a>";
                btns['delete'] = "<a href='javascript:void(0);' class='btn btn-danger btn-xs mbs delete-act'><i class='fa fa-trash-o'></i>删除<\/a>";
                btns['status'] = "<a href='javascript:void(0);' class='btn btn-warning btn-xs mbs status-act'><i class='fa " + status_btn_class + "'></i>" + row._status_btn + "<\/a>";
                var html = [];
                groupBtn.forEach(function (i) {
                    if (btns[i]) {
                        html.push(btns[i]);
                    }
                });
                return html.join('');
            }
            return '未定义按钮';
        },
        /**
         * 操作按钮对应的事件
         * */
        operateEvent: {
            'click .edit-act': function (i, value, row, index) {
                if (!BTable.config.editUrl) {
                    console.error('BTable.config.editUrl is not defined !')
                    return false;
                }
                var param = 'id=' + value;
                if (BTable.config.editUrl.indexOf("?") == -1) {
                    param = '?' + param;
                } else {
                    param = '&' + param;
                }
                if (BTable.config.openNewEditPage) {
                    window.open(BTable.config.editUrl + param + '&close=true');
                } else {
                    window.location.href = BTable.config.editUrl + param;
                }
            },
            'click .status-act': function (i, value, row, index) {
                if (!BTable.config.baseUrl) {
                    console.error('BTable.config.baseUrl is not defined !')
                    return false;
                }
                // var param = '&id=' + value;
                // if (BTable.config.baseUrl.indexOf("?") == -1) {
                //     param = '/' + value;
                // }
                $.ajax({
                    type: "PATCH",
                    url: BTable.config.baseUrl,
                    dataType: "json",
                    data: {
                        id: value,
                        status: row._status_btn == '启用' ? 1 : 0,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.code == 0) {
                            toastr["success"]("操作成功!", "提示");
                            $('#table').bootstrapTable('refresh');
                        } else {
                            toastr["error"](data.message, "提示");
                        }
                    }
                });
            },

            'click .delete-act': function (i, value, row, index) {
                if (!BTable.config.baseUrl) {
                    console.error('BTable.config.baseUrl is not defined !')
                    return false;
                }
                var param = '&id=' + value;
                if (BTable.config.baseUrl.indexOf("?") == -1) {
                    param = '/' + value;
                }
                BootstrapDialog.confirm({
                    title: '提示',
                    message: '此操作不可逆转,确定操作?',
                    type: BootstrapDialog.TYPE_WARNING,
                    closable: true,
                    draggable: true,
                    btnCancelLabel: '取消',
                    btnOKLabel: '确定',
                    btnOKClass: 'btn-warning',
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                type: "DELETE",
                                url: BTable.config.baseUrl + param,
                                success: function (msg) {
                                    toastr["success"]("操作成功!", "提示");
                                    var $table = $('#table');
                                    $table.bootstrapTable('refresh');
                                }
                            });
                        }
                    }
                });
            }
        },
        /**
         * 详细按钮格式化样式
         * */
        detailFormatter: function (index, row) {
            var html = [], data;
            html.push('<dl class="dl-horizontal">');
            data = ('_table_detail' in row) ? row._table_detail : row;
            $.each(data, function (key, value) {
                html.push('<dt>' + key + ' : </dt><dd> ' + value + '</dd>');
            });
            html.push('</dl>');
            return html.join('');
        },
        /**
         * 获取检索表单参数
         * */
        getParams: function (params) {
            var searchdata = $('.form-params').serializeArray();
            if (searchdata.length) {
                jQuery.each(searchdata, function (i, field) {
                    if (field.value != "") {
                        params[field.name] = field.value
                    }
                });
            }
            return params;
        }
    }
}(jQuery);


/* 初始化操作 */
!(function ($) {

    toastr.options = {
        "closeButton": false,
        "hideDuration": "1000",
        "timeOut": "1000",
    };

    /**
     * 按钮工具
     * */
    var btnTools = function () {
        $('.btn-back').click(function () {
            history.back()
        });
    }();

    /**
     * 表单插件初始化操作
     * */
    var initBootstrapTable = function () {
        var $table = $('#table');
        if ($table.length) {
            if (typeof ($table.bootstrapTable) == 'function') {

                /*搜索按钮*/
                $(".form-params #btnSearch").click(function () {
                    $table.bootstrapTable('refresh');
                });


                $(document).on("click", ".btn-edit", function () {
                    $.post($(this).attr('data-url'),
                        function (data) {
                            $table.bootstrapTable('refresh');
                        }, "json");
                });

                /*调整排序排序按钮*/
                $(document).on("click", ".sort-act", function () {
                    var sort = $(this).hasClass('up')?'up':'down';
                    var sortUrl = $(this).attr('data-url');
                    $.ajax({
                        type: "PATCH",
                        url: sortUrl,
                        dataType: "json",
                        data: {
                            sort: sort,
                        },
                        success: function (data) {
                            if (data.code == 0) {
                                toastr["success"]("操作成功!", "提示");
                                $('#table').bootstrapTable('refresh');
                            } else {
                                toastr["error"](data.message, "提示");
                            }
                        }
                    });

                    return;

                    $.ajax({
                        type: "PATCH",
                        url: BTable.config.baseUrl,
                        dataType: "json",
                        data: {
                            id: value,
                            status: row._status_btn == '启用' ? 1 : 0,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.code == 0) {
                                toastr["success"]("操作成功!", "提示");
                                $('#table').bootstrapTable('refresh');
                            } else {
                                toastr["error"](data.message, "提示");
                            }
                        }
                    });

                    $.post($(this).attr('data-url'),
                        function (data) {
                            $table.bootstrapTable('refresh');
                        }, "json");
                });


                /*每5S刷新一次数据*/
                if ($table.hasClass('table-auto-refresh')) {
                    var myInterval = setInterval(function () {
                        $table.bootstrapTable('refresh');
                    }, 5000);
                }
            }
        }
    }();
})(jQuery);


