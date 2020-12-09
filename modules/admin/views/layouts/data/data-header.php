<?php
/**
 * Created by PhpStorm.
 * User: CLZ
 * Date: 2018/1/23
 * Time: 下午2:21
 */

use app\models\statistics\Platform;
use app\components\HtmlPlugin;

$model = new Platform();

?>
<div class="row top-select-tools">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <div class="pull-left">
                    <div class="row-icons pull-left" style="width: 30px;margin: 0px;padding: 0px;">
                        <div class="col-md-3 col-sm-4 " style="margin: 0px;padding: 0px;">
                            <i class="fa fa-credit-card" style="margin: 0px;padding: 0px;"></i>
                        </div>
                    </div>
                    <div class="col-md-2 pull-left" style="width: 150px;"> <?php
                        echo HtmlPlugin::select([
                            'field' => 'platform',
                            'default' => 0,
                            'allData' => '全部平台',
                            'listData' => $model->platforms,
                        ]);
                        ?></div>

                    <div class="col-md-2 pull-left" style="width: 150px;">
                        <?php
                        echo HtmlPlugin::select([
                            'field' => 'category',
                            'default' => 0,
                            'allData' => '全部分类',
                            'listData' => $model->category,
                        ]);
                        ?></div>
                    <div class="col-md-2 pull-left" style="width: 150px;">
                        <?php
                        echo HtmlPlugin::searchSelect([
                            'field' => 'game',
                            'default' => 0,
                            'allData' => '全部游戏',
                            'listData' => $model->game,
                        ]);
                        ?></div>
                    <?php if(isset($opAndVersionSelect)):?>
                        <div class="col-md-2 pull-left" style="width: 200px;">
                            <select title="选择运营商" id="opSelect" data-actions-box="true" class="selectpicker" multiple data-width="170px">
                            </select>
                        </div>
                        <div class="col-md-2 pull-left" style="margin-left:20px;width: 200px;">
                            <select title="选择版本" id="versionSelect" data-actions-box="true" class="selectpicker" multiple data-width="170px">
                            </select>
                        </div>
                    <?endif;?>
                </div>
                <div class="pull-right">
                    <div class="btn btn-default selectDate"><i class="fa fa-calendar"></i>&nbsp;<span></span><i
                                class="fa fa-angle-down"></i>
                        <input type="hidden" name="datestart"/>
                        <input type="hidden" name="endstart"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var selectEvent = {
        eventsList: [],
        addEvent: function (callback) {
            this.eventsList.push(callback);
        },
        trigger: function () {
            for (var i in this.eventsList) {
                this.eventsList[i]();
            }
        }
    }
    <?php $this->beginBlock('js');echo PHP_EOL;?>
    $('.selectpicker').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });
    $('.selectpicker').on('change', function () {
        selectEvent.trigger();
    });
    $('.selectDate').daterangepicker(
        {
            minDate: '2018/01/01',    //最小时间
            maxDate : moment(), //最大时间
            ranges : {
                //'最近1小时': [moment().subtract('hours',1), moment()],
                '今日': [moment().startOf('day'), moment()],
                '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
                '最近7日': [moment().subtract('days', 6), moment()],
                '最近30日': [moment().subtract('days', 29), moment()]
            },
            buttonClasses : [ 'btn btn-default' ],
            applyClass : 'btn-small btn-primary blue',
            cancelClass : 'btn-small',
            format : 'YYYY/MM/DD', //控件中from和to 显示的日期格式
            separator : ' to ',
            startDate: moment().subtract('days', 7),
            endDate: moment(),
            opens: 'left',
            locale : {
                applyLabel : '确定',
                cancelLabel : '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                customRangeLabel : '自定义',
                daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
                    '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                firstDay : 1
            }
        },
        function (start, end) {
            $('.selectDate span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
            selectEvent.trigger();
        }
    );
    $('.selectDate span').html(moment().subtract('days', 7).format('YYYY/MM/DD') + ' - ' + moment().format('YYYY/MM/DD'));
    <?php if(isset($opAndVersionSelect)):?>


    $('#game').on('change',function(){
        var game_id = $('#game').val();
        $.ajax({
            url:'/sdkversion/getopandversion',
            data:{
                id:game_id
            },
            success:function(data){
                if(data.code == 0){
                    let op = data.content.op;
                    let version = data.content.version;
                    let html = '';
                    for(var i in version){
                        html = html + '<option value="' + version[i].value + '">' + version[i].name + '</option>';
                    }
                    $('#versionSelect').html(html);
                    $('#versionSelect').selectpicker('refresh');
                    html = '';
                    for(var i in op){
                        html = html + '<option value="' + op[i].value + '">' + op[i].name + '</option>';
                    }
                    $('#opSelect').html(html);
                    $('#opSelect').selectpicker('refresh');
                }else{

                }
            }
        })
    });
    <?php endif;?>
    <?php $this->endBlock();?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_END); ?>
