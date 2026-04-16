<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-05 21:44:35
 */
use yii\helpers\Html;
use yii\helpers\Url;
$pathInfo = Yii::$app->request->getPathInfo();
?>



<nav class="nav navbar-nav navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">

        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a href="index.html" class="navbar-brand"></a>-->
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li <?php echo $pathInfo == ''?' class="active"':'';?>><a href="<?php echo Url::to('/'); ?>"><?php
                        if (strpos(Yii::$app->language,'ar')===0) {
                            echo 'الرئيسية';
                        } elseif (strpos(Yii::$app->language,'en')===0) {
                            echo 'Home';
                        } else {
                            echo '首页';
                        }
                    ?></a>
                    </li>


                    <?php  $ctdatas=$this->params['items']; ?>
                    <?php   foreach ($ctdatas as $key => $value) { ?>

                    <li <?php echo $pathInfo == 'category-'.$value['id'].'.html'?' class="active"':'';?>>
                        <a class="text-gray" style="color:#fff"
                            href="<?php echo Url::to('/category-'.$value['id'].'.html'); ?>">
                            <?=$value['title'];?>
                        </a>
                    </li>
                    <?php } ?>


                </ul>


                <div class="navbar-form navbar-right">
                    <input type="text" name="wd" class="form-control" id="search_article" placeholder="<?php
                        if (strpos(Yii::$app->language,'ar')===0) {
                            echo 'ابحث في الأخبار';
                        } elseif (strpos(Yii::$app->language,'en')===0) {
                            echo 'Search news';
                        } else {
                            echo '请输入搜索的内容';
                        }
                    ?>">
                    <button class="btn btn-default search-btn" type="button"><?php
                        if (strpos(Yii::$app->language,'ar')===0) {
                            echo 'بحث';
                        } elseif (strpos(Yii::$app->language,'en')===0) {
                            echo 'Search';
                        } else {
                            echo '搜索';
                        }
                    ?></button>
                </div>
            </div>
        </div>
    </div>


</nav>

<div class="container">
    <div class="">
        <div class="col-g-12">
            <div class="col-g-5">

                <div class="logo">
                    <a href="/"><img src="/web/assets/news/images/logo.png"></a>
                </div>
            </div>
            <div class="col-g-7 pull-right">
                <div class="bunner-g-1">

                  <?php
                    if (strpos(Yii::$app->language,'ar')===0) {
                        echo 'الإنترنت - خدمة شاملة';
                    } elseif (strpos(Yii::$app->language,'en')===0) {
                        echo 'Internet - Full Service';
                    } else {
                        echo '互联网-全方位服务';
                    }
                  ?>

                </div>

            </div>
        </div>
    </div>

</div>
