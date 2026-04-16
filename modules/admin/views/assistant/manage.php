<?php
/**
 * Created by aiman
 * User: aiman
 */

use app\modules\admin\models\SysUsers as SelfModel;
use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\SearchPlugin;

AdminAsset::loadBootstrapTablePlugin($this);
AdminAsset::set('vue-manage.bundle', $this);

?>
<style>

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading" data-default="title">loading...</div>

            <div class="panel-body manage-container" id="manage-row">

                <div class="row" id="toolbar" style="margin-bottom: 15px">
                    <div class="col-md-6">
                        <div class="form-inline">
                            <div class="form-group">

                                <a v-show="btnSetting.createBtn" v-on:click="createAction" class="btn btn-green"
                                   style="display: none;"
                                   href="javascript:void(0);"><i
                                            class="fa fa-plus"></i>新增</a>
                                <a v-show="btnSetting.delBtn & btnSetting.batchOperate" v-on:click="batchDeleteAction"
                                   class="btn btn-danger"
                                   style="display: none;" href="javascript:void(0);"><i
                                            class="fa fa-trash-o"></i>删除</a>
                                <a v-show="btnSetting.statusBtn & btnSetting.batchOperate"
                                   v-on:click="batchStatusAction('disabled')" class="btn btn-warning"
                                   style="display: none;" href="javascript:void(0);"><i
                                            class="fa fa-ban"></i>禁用</a>
                                <a v-show="btnSetting.statusBtn & btnSetting.batchOperate"
                                   v-on:click="batchStatusAction('enabled')" class="btn btn-success"
                                   style="display: none;" href="javascript:void(0);"><i
                                            class="fa fa-check-circle"></i>启用</a>

                                <a class="btn btn-info" v-on:click="exportAction" href="javascript:void(0);">
                                    <i class="fa fa-wrench"></i>导出</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <form action="#" onsubmit="return false;" class="form-inline form-params" method="post">
                            <div class="form-group" v-if="btnSetting.searchBtn">
                                <label class="control-label">搜索词：</label>
                                <input id="relatedWord" name="searchWord" v-model="searchWord"
                                       v-on:keyup.enter="searchData" type="text" size="22"
                                       placeholder="请输入关键词" class="ipt form-control">
                                <button type="button" class="btn btn-green" v-on:click="searchData"><i
                                            class="fa fa-search"></i>搜索
                                </button>
                                <button v-show="btnSetting.filterBtn" v-on:click="showFilterForm" style="display: none;"
                                        type="button"
                                        class="btn btn-info">
                                    <i class="fa fa-chevron-down" style="display: none;" v-show="!showFilter"></i>
                                    <i class="fa fa-chevron-up" style="display: none;" v-show="showFilter"></i>
                                    筛选
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row animated fadeInDown" style="display: none;" v-show="showFilter">
                    <div class="col-md-12">
                        <div class="well well-sm">
                            <form action="#" class="horizontal-form" id="filterForm">
                                <div class="form-body pal">
                                    <?php echo SearchPlugin::init($model->getSearchfilterRules()); ?>
                                    <div class="form-actions text-right pal">
                                        <a class="btn btn-primary" href="javascript:void(0);"
                                           v-on:click="searchData">确定</a>&nbsp;
                                        <button type="button" class="btn btn-green" v-on:click="showFilterForm">取消
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive-row">
                    <table class="table table-hover table-striped table-advanced table-bordered table-border-radius">
                        <thead>
                        <tr v-cloak>
                            <th v-if="theadSetting.detailView" style="text-align:center; width: 34px;">&nbsp;</th>
                            <th v-if="theadSetting.btSelectAll"
                                v-on:click="allSelect" style="text-align:center; width:40px;">
                                <i class="fa" v-bind:class="[checkedAll ? 'fa-check-circle-o' : 'fa-circle-o']"></i>
                            </th>
                            <th v-for="(item, index) in tableThead">
                                {{item.comment}}
                                <i class="fa"
                                   v-if="item.option=='sort'"
                                   v-bind:class="[item.sortAsc ? 'fa-sort-desc' : 'fa-sort-asc']"
                                   v-on:click="sortByField(index)"></i>
                            </th>
                            <th v-if="theadSetting.sort" style="text-align: center">排序</th>
                            <th v-if="theadSetting.option" style="text-align: center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in content.items" v-show="!loading" v-cloak>

                            <td v-if="theadSetting.detailView" v-on:click="onViewDetail(index,$event)">
                                <i class="fa" v-bind:class="[item.viewDetail ? 'fa-eye' : 'fa-eye-slash']"></i>
                            </td>

                            <td v-if="theadSetting.btSelectAll" v-on:click="singleSelect(index)"
                                style="text-align: center">
                                <i class="fa" v-bind:class="[item.checked ? 'fa-check-circle-o' : 'fa-circle-o']"></i>
                            </td>


                            <td v-for="field in listBytableThead(item)" v-html="field"></td>

                            <td class="remove-inline-block-space" v-if="theadSetting.sort" style="text-align: center;">

                                <a class="btn btn-xs btn-green"
                                   v-on:click="sortAction(item,'up')"
                                   href="javascript:void(0);">
                                    <i class="fa fa-arrow-up"></i></a>

                                <a class="btn btn-xs btn-warning"
                                   v-on:click="sortAction(item,'down')"
                                   href="javascript:void(0);"><i
                                            class="fa fa-arrow-down"></i></a>

                            </td>

                            <td class="remove-inline-block-space" v-if="theadSetting.option"
                                style="text-align: center;">

                                <div v-if="btnSetting.dropdownBtn" class="btn-group">
                                    <button type="button" data-toggle="dropdown" class="dropdown-toggle"
                                            v-bind:class="btnSetting.dropdownBtn.class">
                                        {{btnSetting.dropdownBtn.name}} &nbsp;
                                        <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li v-for="menu in btnSetting.dropdownBtn.menu"
                                            v-on:click="dropdownBtnAction(item,btnSetting.dropdownBtn.field,menu.value)">
                                            <a href="javascript:void(0);">{{menu.name}}</a>
                                        </li>
                                    </ul>
                                </div>

                                <a v-if="btnSetting.editBtn"
                                   v-on:click="editAction(item)"
                                   href="javascript:void(0);"
                                   class="btn btn-xs btn-green"><i
                                            class="fa fa-edit"></i>编辑</a>
                                <a v-if="btnSetting.statusBtn&item.enabled==true"
                                   v-on:click="statusAction(item)"
                                   href="javascript:void(0);"
                                   class="btn btn-xs btn-warning"><i
                                            class="fa fa-ban"></i>禁用</a>
                                <a v-if="btnSetting.statusBtn&item.enabled==false"
                                   v-on:click="statusAction(item)"
                                   href="javascript:void(0);"
                                   class="btn btn-xs btn-success"><i
                                            class="fa fa-check-circle"></i>启用</a>
                                <a v-if="btnSetting.delBtn"
                                   v-on:click="deleteAction(item)"
                                   href="javascript:void(0);"
                                   class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash-o"></i>删除</a>

                                <a v-for="btn in buttons"
                                   v-bind:href="initButtonHref(btn,item)"
                                   v-bind:class="btn.class"
                                   v-bind:target="btn.target"
                                   v-on:click="buttonEvnets(btn,item)">
                                    <i v-bind:class="btn.icon"></i>
                                    {{btn.name}}
                                </a>


                            </td>
                        </tbody>
                    </table>
                <div>
                    <p v-show="loading" id="loading" v-cloak style="text-align: center">{{message}}</p></div>

                <manage-pagination v-show="!loading" style="display: none;"
                                   v-on:changepagesize="changePageSize"
                                   v-on:gotopageno="changePageNo"
                                   v-bind:total-pages="content.total_pages"
                                   v-bind:total-items="content.total_items"
                                   v-bind:before="content.before"
                                   v-bind:next="content.next"
                                   v-bind:current="content.current"
                                   v-bind:page-size="pageSize"></manage-pagination>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function eventBtn(item) {
        console.table(item);
    }

    var DataTable = {};
    DataTable.config = {
        baseUrl: "<?php echo Url::to('/admin/assistant') ?>",
        primaryKey: "<?php echo SelfModel::PRIMARY_KEY ?>",
        theadData: <?php echo json_encode($model->getAssistantManageTableHead()); ?>,
        searchWord: "<?php echo $_GET['searchWord'] ?? ''?>",
        theadSetting: {
            'btSelectAll': false,
            'detailView': true,
            'option': true,
            'sort': false
        },
        btnSetting: {
            'createBtn': true,
            'delBtn': false,
            'editBtn': true,
            'statusBtn': true,
            'searchBtn': true,
            'filterBtn': false,
            'batchOperate': false,
            'dropdownBtn_': {
                'name': '操作',
                'field': 'id',
                'class': 'btn btn-xs btn-danger',
                'menu': [
                    {'name': '设为黑名单', 'value': 'changeStatusTo2'},
                    {'name': '取消黑名单', 'value': 'changeStatusTo1'},
                ]
            }
        },
        openNewEditPage: false,
        pageSize: 20,
        buttons_: [
            {
                'type': 'button',
                'name': '链接按钮',
                'class': 'btn btn-xs btn-danger',
                'icon': 'fa fa-edit',
                'href': 'http://qav.itv.com/anchor/index.html',
                'relatedField': ['id'],
                'target': '_blank',
            },
            {
                'type': 'button-class',
                'name': '自定义 Class',
                'class': 'btn btn-xs btn-success selfClass',
                'icon': 'fa fa-edit',
            },
            {
                'type': 'button-event',
                'name': '事件按钮',
                'class': 'btn btn-xs btn-danger',
                'icon': 'fa fa-edit',
                'callback': eventBtn,
            },
        ]
    };
</script>