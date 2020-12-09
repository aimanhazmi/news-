$(document).on('mouseover', "#manage-row", function () {
    $("[data-toggle='tooltip'], [data-hover='tooltip']").tooltip();
    $("[data-toggle='popover'], [data-hover='popover']").popover();
});

function initJq() {

    $('.selectpicker').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });

    $('input[name="daterangepicker-default"]').daterangepicker({
            format: 'YYYY-MM-DD'
        }, function (start, end) {
            var vm = this.element;
            vm.siblings('.start_date').val(start.format("YYYY-MM-DD"));
            vm.siblings('.end_date').val(end.format("YYYY-MM-DD"));
        }
    );

    $('input[name="daterangepicker-date-time"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'YYYY-MM-DD HH:mm A'
    }, function (start, end) {

        $('input[name="start_time"]').val(start.format("YYYY-MM-DD HH:mm:ss"));
        $('input[name="end_time"]').val(end.format("YYYY-MM-DD HH:mm:ss"));
    });

    $('.reportrange').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            opens: 'left'
        },
        function (start, end) {
            $('.reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $('input[name="start_date"]').val(start.format("YYYY-MM-DD"));
            $('input[name="end_date"]').val(end.format("YYYY-MM-DD"));
        }
    );
    $('.reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

}

Vue.component('manage-pagination', {
    props: ['totalPages', 'totalItems', 'pageSize', 'before', 'next', 'current'],
    template: '<div class="fixed-table-pagination" v-cloak>\n' +
    '                    <div class="pull-left pagination-detail"><span\n' +
    '                                class="pagination-info">共 {{ totalPages }} 页，合计 {{ totalItems }} 条记录</span><span\n' +
    '                                class="page-list">，每页显示 <span class="btn-group dropup">\n' +
    '                                <button type="button"\n' +
    '                                        class="btn btn-default dropdown-toggle"\n' +
    '                                        data-toggle="dropdown">\n' +
    '                                    <span class="page-size">{{ pageSize }}</span>\n' +
    '                                    <span class="caret"></span></button>\n' +
    '                                     <ul class="dropdown-menu" role="menu"><li role="menuitem"><a\n' +
    '                                                     href="javascript:void(0);"\n' +
    '                                                     v-on:click="changePageSize(5)">5</a></li><li\n' +
    '                                                 role="menuitem"><a href="javascript:void(0);"\n' +
    '                                                                    v-on:click="changePageSize(10)">10</a></li><li\n' +
    '                                                 role="menuitem"><a\n' +
    '                                                     href="javascript:void(0);"\n' +
    '                                                     v-on:click="changePageSize(20)">20</a></li><li role="menuitem"><a\n' +
    '                                                     href="javascript:void(0);"\n' +
    '                                                     v-on:click="changePageSize(50)">50</a></li></ul>\n' +
    '                            </span> 条记录</span></div>\n' +
    '                    <div class="pull-right pagination">\n' +
    '                        <ul class="pagination">\n' +
    '                            <li class="page-number" v-show="current!=1"><a href="javascript:void(0);" v-on:click="gotoPageNo(1)">首页</a></li>\n' +
    '                            <li class="page-pre" v-show="current!=before"><a href="javascript:void(0);" v-on:click="gotoPageNo(before)">上一页</a></li>\n' +
    '                            <li class="page-number" v-for="index in pages" :class="{active:current == index}" :key="index"><a href="javascript:void(0);" v-on:click="gotoPageNo(index)">{{index}}</a></li>\n' +
    '                            <li class="page-next" v-show="current!=next"><a href="javascript:void(0);" v-on:click="gotoPageNo(next)">下一页</a></li>\n' +
    '                            <li class="page-number" v-show="current!=totalPages"><a href="javascript:void(0);" v-on:click="gotoPageNo(totalPages)">末页</a></li>\n' +
    '                        </ul>\n' +
    '                    </div>\n' +
    '                </div>',
    data: function () {
        return {
            showItem: 5,
        }
    },
    methods: {
        changePageSize: function (pageSize) {
            this.$emit('changepagesize', pageSize)
        },
        gotoPageNo: function (pageNo) {
            this.$emit('gotopageno', pageNo);
        }
    },
    computed: {
        pages: function () {
            var pageList = [];
            if (this.current < this.showItem) {
                var i = Math.min(this.showItem, this.totalPages);
                while (i) {
                    pageList.unshift(i--);
                }
            } else {
                var middle = this.current - Math.floor(this.showItem / 2),
                    i = this.showItem;
                if (middle > (this.totalPages - this.showItem)) {
                    middle = (this.totalPages - this.showItem) + 1
                }
                while (i--) {
                    pageList.push(middle++);
                }
            }
            return pageList
        }
    },
})

var manageVm = new Vue({
    el: '#manage-row',
    data() {
        return {
            loadingMessage: '数据正在加载中...',
            message: '数据正在加载中...',
            primaryKey: 'id',
            searchWord: '',
            loading: true,
            content: {
                'total_pages': 0,
                'total_items': 0,
                'before': 0,
                'next': 0,
                'current': 0,
            },
            theadSetting: {'btSelectAll': true, 'detailView': true, 'option': true, 'sort': false},
            tableThead: {},
            btnSetting: {'createBtn': true, 'delBtn': true, 'editBtn': true, 'statusBtn': true, 'orderBtn': false},
            showFilter: false,
            checkedAll: false,
            baseUrl: '',
            editUrl: '',
            defaultPageSize: 20,
            openNewEditPage: false,
            pageSize: 20,
            pageNo: 1,
            viewDetailDom: [],
            buttons: [],
            searchParams: {},
            customerSearchParams: {},
            callbacks: {},
        }
    },
    methods: {
        searchData: function () {
            var vm = this
            vm.loading = true
            vm.checkedAll = false
            vm.unsetDetailView()
            vm.message = vm.loadingMessage;

            let searchParams = $.extend({
                page_size: vm.pageSize,
                page_no: vm.pageNo,
                searchWord: vm.searchWord,
            }, vm.searchParams,vm.customerSearchParams)

            $.ajax({
                type: 'GET',
                url: DataTable.config.baseUrl + '?' + vm.getSearchParams(),
                contentType: 'application/x-www-form-urlencoded',
                data: searchParams,
                dataType: 'json',
                success: function (result) {
                    if (result.code == 0) {
                        vm.content = result.content;
                        vm.loading = false;
                    } else {
                        vm.resetSearchParameter();
                        vm.message = result.message;
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    toastr["error"]('HTTP Status Code' + XMLHttpRequest.status, "提示");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        },
        getSearchParams() {
            if (!this.showFilter) return ''
            return $('#filterForm').serialize()
        },
        fromNow: function (timestamp) {
            return moment(moment.unix(timestamp)).fromNow();
        },
        listBytableThead: function (row) {
            let vm = this
            let tableThead = vm.tableThead
            let rowData = []
            for (let key in tableThead) {
                let option = tableThead[key].option
                switch (option) {
                    case 'img':
                        rowData.push('<a href="' + row[key] + '" data-lightbox="roadtrip"><img src="' + row[key] + '" class="mvImg"></a>')
                        break;
                    case 'tooltip':
                        rowData.push('<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" data-original-title="' + row[tableThead[key].dataField] + '">' + row[key] + '</a>')
                        break;
                    case 'popover':
                        rowData.push('<a href="javascript:void(0);" data-container="body" data-toggle="popover" data-placement="right" data-content="' + row[tableThead[key].dataField] + '" title="' + row[key] + '">' + row[key] + '</a>')
                        break;
                    case 'link':
                        rowData.push('<a href="' + row[tableThead[key].dataField] + '" target="_blank"> ' + row[key] + ' </a>')
                        break;
                    default:
                        rowData.push(row[key])
                }
            }
            return rowData;
        },
        onViewDetail: function (index, event) {
            let vm = this
            let currentViewStatus = vm.content.items[index].viewDetail;
            vm.unsetDetailView()

            vm.content.items[index].viewDetail = currentViewStatus ? false : true;
            vm.content.items = Object.assign([], vm.content.items); // 重建对象,可以改变 vue 原始数据对象

            let btn = event.target;
            let btnTagName = btn.tagName
            if (btnTagName.toLowerCase() == 'i') {
                btn = event.target.parentNode;
            }
            let row = vm.content.items[index];
            let tr = btn.parentNode;
            let nextTr = tr.nextSibling;
            let tbody = tr.parentNode;
            if (vm.content.items[index].viewDetail) {
                let container = document.createElement("tr");
                let td = document.createElement("td");
                container.className = 'detail-view';
                td.setAttribute("colspan", tr.children.length);
                // 渲染数据
                let html = [], data;
                html.push('<dl class="dl-horizontal animated fadeInRight">');
                data = ('_table_detail' in row) ? row._table_detail : row;
                $.each(data, function (key, value) {
                    html.push('<dt>' + key + ' : </dt><dd> ' + value + '</dd>');
                });
                html.push('</dl>');
                td.innerHTML = html.join('');
                container.appendChild(td);
                tbody.insertBefore(container, nextTr)
            } else {
                // 移除
                if (nextTr.className == 'detail-view') {
                    tbody.removeChild(nextTr)
                }
            }
        },
        sortAction: function (row, sorType) {
            let vm = this
            let primaryKey = vm.primaryKey;
            let requestUrl = vm.baseUrl + '/' + row[primaryKey];
            $.ajax({
                type: 'PATCH', //PATCH // PUT
                url: requestUrl,
                data: {sortOperate: sorType},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        toastr["success"]("操作成功!", "提示");
                        vm.searchData();
                    } else {
                        toastr["error"](data.message, "提示");
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        },
        statusAction: function (row) {
            let vm = this
            let primaryKey = vm.primaryKey;
            let requestUrl = vm.baseUrl + '/' + row[primaryKey];

            BootstrapDialog.confirm({
                title: '提示',
                message: '此操作为关键性操作,确定操作?',
                type: BootstrapDialog.TYPE_WARNING,
                closable: true,
                draggable: true,
                btnCancelLabel: '取消',
                btnOKLabel: '确定',
                btnOKClass: 'btn-warning',
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            type: 'PATCH',
                            url: requestUrl,
                            data: {changeStatus: true},
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 0) {
                                    toastr["success"]("操作成功!", "提示");
                                    vm.searchData();
                                } else {
                                    toastr["error"](data.message, "提示");
                                }
                            },
                            error: function () {
                                console.log('error');
                            }
                        });
                    }
                }
            });
        },
        createAction: function (event, suffix) {
            let requestUrl = this.baseUrl + '/new.html' + (suffix ? suffix : '');
            window.location.href = requestUrl;
        },
        editAction: function (row, openNewPage) {
            let vm = this
            let primaryKey = vm.primaryKey;
            let requestUrl = vm.baseUrl + '/edit.html';
            if (vm.openNewEditPage == true || openNewPage) {
                window.open(requestUrl + '?id=' + row[primaryKey])
            } else {
                window.location.href = requestUrl + '?id=' + row[primaryKey];
            }
        },
        deleteAction: function (row) {

            let vm = this
            let primaryKey = vm.primaryKey;
            let requestUrl = vm.baseUrl + '/' + row[primaryKey];

            BootstrapDialog.confirm({
                title: '提示',
                message: '此操作不可逆转,确定操作?',
                type: BootstrapDialog.TYPE_DANGER,
                closable: true,
                draggable: true,
                btnCancelLabel: '取消',
                btnOKLabel: '确定',
                btnOKClass: 'btn-danger',
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: requestUrl,
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 0) {
                                    toastr["success"]("操作成功!", "提示");
                                    vm.searchData();
                                } else {
                                    toastr["error"](data.message, "提示");
                                }
                            },
                            error: function () {
                                console.log('error');
                            }
                        });
                    }
                }
            });
        },
        batchDeleteAction: function () {
            let vm = this
            let ids = vm.getSelectIds()
            let requestUrl = vm.baseUrl + '/batch';
            if (ids.length) {
                BootstrapDialog.confirm({
                    title: '提示',
                    message: '此操作不可逆转,确定操作?',
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: true,
                    draggable: true,
                    btnCancelLabel: '取消',
                    btnOKLabel: '确定',
                    btnOKClass: 'btn-danger',
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                type: 'DELETE',
                                url: requestUrl,
                                data: {ids: ids},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.code == 0) {
                                        toastr["success"]("操作成功!", "提示");
                                        vm.searchData();
                                    } else {
                                        toastr["error"](data.message, "提示");
                                    }
                                },
                                error: function () {
                                    toastr["error"]('数据接口响应失败!', "提示");
                                    console.log('error');
                                }
                            });
                        }
                    }
                });
            }
        },
        batchStatusAction: function (status) {
            let vm = this
            let ids = vm.getSelectIds()
            let requestUrl = vm.baseUrl + '/batch';
            if (ids.length) {
                BootstrapDialog.confirm({
                    title: '提示',
                    message: '此操作为关键性操作,确定操作?',
                    type: BootstrapDialog.TYPE_WARNING,
                    closable: true,
                    draggable: true,
                    btnCancelLabel: '取消',
                    btnOKLabel: '确定',
                    btnOKClass: 'btn-danger',
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                type: 'PATCH',
                                url: requestUrl,
                                data: {ids: ids, status: status},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.code == 0) {
                                        toastr["success"]("操作成功!", "提示");
                                        vm.searchData();
                                    } else {
                                        toastr["error"](data.message, "提示");
                                    }
                                },
                                error: function () {
                                    toastr["error"]('数据接口响应失败!', "提示");
                                    console.log('error');
                                }
                            });
                        }
                    }
                });
            }
        },
        exportAction: function () {
            toastr["info"]('暂未开放!', "提示");
        },
        dropdownBtnAction: function (row, field, status) {
            let vm = this
            let primaryKey = vm.primaryKey;
            let requestUrl = vm.baseUrl + '/' + row[primaryKey];
            BootstrapDialog.confirm({
                title: '提示',
                message: '此操作为关键性操作,确定操作?',
                type: BootstrapDialog.TYPE_WARNING,
                closable: true,
                draggable: true,
                btnCancelLabel: '取消',
                btnOKLabel: '确定',
                btnOKClass: 'btn-warning',
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            type: 'PATCH',
                            url: requestUrl,
                            data: {field: status},
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 0) {
                                    toastr["success"]("操作成功!", "提示");
                                    vm.searchData();
                                } else {
                                    toastr["error"](data.message, "提示");
                                }
                            },
                            error: function () {
                                console.log('error');
                            }
                        });
                    }
                }
            });
        },
        changePageSize: function (pageSize) {
            this.pageSize = pageSize
            this.searchData();
        },
        changePageNo: function (pageNo) {
            if (this.pageNo != pageNo) {
                this.pageNo = pageNo
                this.searchData();
            } else {
                toastr["info"]("已经是当前页了!", "提示");
            }
        },
        allSelect() {
            let vm = this;
            vm.checkedAll = vm.checkedAll ? false : true;
            vm.content.items.forEach(item => {
                item.checked = vm.checkedAll
            })
            vm.content.items = Object.assign([], vm.content.items);
        },
        singleSelect(index) {
            let vm = this;
            vm.content.items[index].checked = vm.content.items[index].checked ? false : true;
            // 重建对象,可以改变 vue 原始数据对象
            vm.content.items = Object.assign([], vm.content.items);
            // 归置全选按钮
            if (!vm.content.items[index].checked) {
                vm.checkedAll = false;
            } else {
                // 标记全选
                if (vm.getSelectIds().length == vm.content.items.length) {
                    vm.checkedAll = true;
                }
            }
        },
        getSelectIds() {
            let vm = this;
            let primaryKey = vm.primaryKey;
            let ids = [];
            if (Array.isArray(vm.content.items)) {
                vm.content.items.forEach(item => {
                    if (item.checked) {
                        ids.push(item[primaryKey]);
                    }
                })
            }
            return ids;
        },
        sortByField(field) {
            let vm = this;
            // 初始化对象数据
            vm.tableThead[field].sortAsc = vm.tableThead[field].sortAsc ? false : true;
            // 重建对象,可以改变 vue 原始数据对象
            vm.tableThead = Object.assign({}, vm.tableThead);
        },
        showFilterForm: function () {
            this.showFilter = this.showFilter ? false : true;
        },
        loadSetting: function () {
            this.theadSetting = Object.assign(this.theadSetting, DataTable.config.theadSetting)
            this.tableThead = Object.assign(this.tableThead, DataTable.config.theadData)
            this.btnSetting = Object.assign(this.btnSetting, DataTable.config.btnSetting)
            this.baseUrl = DataTable.config.baseUrl
            this.primaryKey = DataTable.config.primaryKey
            this.pageSize = DataTable.config.pageSize
            this.buttons = Object.assign(this.buttons, DataTable.config.buttons)
            this.searchWord = DataTable.config.searchWord
            this.searchParams = DataTable.config.searchParams
            this.customerSearchParams = DataTable.config.customerSearchParams
            this.callbacks = DataTable.config.callbacks
        },
        resetSearchParameter: function () {
            this.pageNo = 0
            this.pageSize = this.defaultPageSize
        },
        unsetDetailView: function () {
            let vm = this;
            if (vm.content.items instanceof Array) {
                vm.content.items.forEach(item => {
                    // console.log(item);
                    item.viewDetail = false
                })
                vm.content.items = Object.assign([], vm.content.items)
                let detailView = $(vm.$el).find('.detail-view')
                $.each(detailView, function (i, item) {
                    $(item).remove();
                });
            }
        },
        buttonEvnets: function (btn, row) {
            if (btn.callback) {
                btn.callback(row);
            }
        },
        initButtonHref: function (btn, row) {
            if (btn.href) {
                let href = [];
                let link = '';
                for (var i in btn.relatedField) {
                    if (row[btn.relatedField[i]]) {
                        href.push(btn.relatedField[i] + "=" + row[btn.relatedField[i]]);
                    }
                }
                link = href.join("&");
                return btn.href + '?' + link;
            }
            return 'javascript:void(0);';
        },
        callbackAction: function (callback, row) {
            let vm = this
            vm.callbacks[callback](this, row, function () {
                vm.searchData();
            });
        },
    },
    beforeMount: function () {

    },
    created: function () {
        this.loadSetting();

    },
    mounted: function () {
        var vm = this;
        this.$nextTick(function () {
            vm.searchData();
            $('[data-toggle="tooltip"]').tooltip()
        })
        initJq();
    },
    watch: {
        'content': {
            handler: function (val, oldVal) {
                // console.log(val);
                // console.log(oldVal);

            },
            deep: true
        }
    },
});


