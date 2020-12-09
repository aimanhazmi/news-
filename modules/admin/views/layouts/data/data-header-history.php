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
<style>
    [v-cloak] {
        display: none;
    }
    #top-toolbar .form-group {
        margin-bottom: 0px;
    }
    .nowrap{
        white-space:nowrap;
    }
    .top-select-tools{
        position: relative;
        z-index: 888;
    }
</style>
<div class="row top-select-tools">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <div class="row" id="top-toolbar">
                    <form action="#" class="form-horizontal">
                        <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="daterangepicker-date-time" placeholder="请输入时间范围" class="form-control">
                                <input type="hidden" class="start_time" name="start_time">
                                <input type="hidden" class="end_time" name="end_time">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <?php
                            echo HtmlPlugin::select([
                                'name'     => '直播平台',
                                'field'    => 'platform',
                                'default'  => 0,
                                'listData' => $model->platforms,
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <?php
                            echo HtmlPlugin::select([
                                'name'     => '直播分类',
                                'field'    => 'category',
                                'default'  => 0,
                                'listData' => $model->category,
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <?php
                            echo HtmlPlugin::searchSelect([
                                'name'     => '游戏',
                                'field'    => 'game',
                                'default'  => 0,
                                'listData' => $model->game,
                            ]);
                            ?>
                        </div>
                    </form>
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
    $('input[name="daterangepicker-date-time"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'YYYY-MM-DD'
    }, function (start, end) {
        $('input[name="start_time"]').val(start.format("YYYY-MM-DD HH:mm:ss"));
        $('input[name="end_time"]').val(end.format("YYYY-MM-DD HH:mm:ss"));
        selectEvent.trigger();
    });
    $('.selectpicker').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });
    $('.selectpicker').on('change', function () {
        selectEvent.trigger();
    });
    <?php $this->endBlock();?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_END); ?>
