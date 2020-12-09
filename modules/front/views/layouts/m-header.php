<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 21:44:35
 */
use yii\helpers\Html;
use yii\helpers\Url;
$pathInfo = Yii::$app->request->getPathInfo();
?>





<div class="container m-headers">
    <div class="">
        <div class="col-g-12">
            <div class="col-g-5">

                <div class="logo">
                    <a href="/"><img src="/web/assets/news/images/logo.png"></a>
                </div>
            </div>
            <div class="col-g-7 pull-right">
                <div class="bunner-g-1">

                互联网-全方位服务

                </div>

            </div>
        </div>
    </div>

</div>

<div class="">
    <div class="mini-c row" style="width:100%;overflow-y: hidden;overflow-x: auto;">

        <ul class=" " style="display: flex;flex-direction: row;-moz-box-shadow:0px 0.5px  #f1f1f1;box-shadow:0px 0.5px  #f1f1f1;">
            <li class="mini-i" style="flex-shrink: 0;list-style:none">
                <a style="" href="<?php echo Url::to('/'); ?>">首页</a>
            </li>

            <?php  $ctdatas=$this->params['items']; ?>
            <?php   foreach ($ctdatas as $key => $value) { ?>
            <li style="flex-shrink: 0;list-style:none"
                <?php echo $pathInfo == 'category-'.$value['id'].'.html'?' class="active"':'';?>>
                <a style="" href="<?php echo Url::to('/category-'.$value['id'].'.html'); ?>">
                    <?=$value['title'];?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>