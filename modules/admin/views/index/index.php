<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/24
 * Time: 13:49
 */

use yii\helpers\Html;
use app\assets\AdminAsset;
?>
<style>
    i.fa-globe {
        color: #2980b9;
    }

    i.fa-clock-o {
        color: #27ae60;
    }
    #sum_box .mbm .icon-a {
        color: #5cb85c;
    }
    #sum_box .mbm .icon-b {
        color: #5bc0de;
    }
    #sum_box .mbm .icon-c {
        color: #d9534f;
    }
    #sum_box .mbm .icon-d {
        color: #f0ad4e;
    }

</style>
<div id="tab-general">
    <div class="row">
        <div class="col-md-12">

            <div id="sum_box" class="row mbl">
                <div class="col-sm-6 col-md-3">
                    <div class="panel profit db mbm">
                        <div class="panel-body">
                            <p class="icon"><i class="icon fa fa-user icon-a"></i>
                            </p>
                            <h4 class="value"><span><?= $userAnalysis["今日访客"]??0;?></span></h4>
                            <p class="description">今日新增游客</p>
                            <div class="progress progress-sm mbn">
                                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" class="progress-bar progress-bar-success"><span class="sr-only">80% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="panel income db mbm">
                        <div class="panel-body">
                            <p class="icon"><i class="icon fa fa-group icon-b"></i>
                            </p>
                            <h4 class="value"><span><?= $userAnalysis["总访客"]??0;?></span></h4>
                            <p class="description">游客总数</p>
                            <div class="progress progress-sm mbn">
                                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" class="progress-bar progress-bar-info"><span class="sr-only">60% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="panel task db mbm">
                        <div class="panel-body">
                            <p class="icon"><i class="icon fa fa-user icon-c"></i>
                            </p>
                            <h4 class="value"><span><?= $userAnalysis["今日注册客户"]??0;?></span></h4>
                            <p class="description">今日新增会员</p>
                            <div class="progress progress-sm mbn">
                                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" class="progress-bar progress-bar-danger"><span class="sr-only">50% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="panel visit db mbm">
                        <div class="panel-body">
                            <p class="icon"><i class="icon fa fa-group icon-d"></i>
                            </p>
                            <h4 class="value"><span><?= $userAnalysis["总客户"]??0;?></span></h4>
                            <p class="description">会员总数</p>
                            <div class="progress progress-sm mbn">
                                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" class="progress-bar progress-bar-warning"><span class="sr-only">70% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> 在线统计</div>
                <div class="panel-body">
                    <div id="online-chart">加载中...</div>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> 日注册曲线</div>
                <div class="panel-body">
                    <div id="chart2">加载中...</div>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> 日IP曲线</div>
                <div class="panel-body">
                    <div id="chart3">加载中...</div>
                </div>
            </div>
        </div>
    </div>
    <div id="sys-action-log"></div>
</div>
<?php //echo $this->registerJsFile('@web/static/app/index/index.min.js'); ?>
<script>
    <?php $this->beginBlock('js') ?>
    $(function () {
        $('#page-wrapper').addClass('animated fadeInDown');
    });
    <?php $this->endBlock() ?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_END); ?>
