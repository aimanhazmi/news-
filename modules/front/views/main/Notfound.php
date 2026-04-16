<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="<?= strpos(Yii::$app->language,'ar')===0 ? 'rtl' : 'ltr' ?>">

<head>
    <meta charset="UTF-8">
    <title><?php
        if (strpos(Yii::$app->language,'ar')===0) {
            echo 'الصفحة غير موجودة';
        } elseif (strpos(Yii::$app->language,'en')===0) {
            echo 'Page Not Found';
        } else {
            echo '404页面';
        }
    ?></title>
    <link rel="stylesheet" type="text/css" href="/web/assets/news/404/css/style.css" />
</head>

<body>
    <div class="anim">
        <a href="/">
            <div class="tooltip" title="<?php
                if (strpos(Yii::$app->language,'ar')===0) {
                    echo 'اضغط للعودة';
                } elseif (strpos(Yii::$app->language,'en')===0) {
                    echo 'Click to return';
                } else {
                    echo '点击我呀！=^_^=';
                }
            ?>">
                <div><?php
                    if (strpos(Yii::$app->language,'ar')===0) {
                        echo 'الصفحة غير موجودة';
                    } elseif (strpos(Yii::$app->language,'en')===0) {
                        echo 'Page not found';
                    } else {
                        echo '网页跑丢了';
                    }
                ?></div>
                <div><?php
                    if (strpos(Yii::$app->language,'ar')===0) {
                        echo 'اضغط للعودة';
                    } elseif (strpos(Yii::$app->language,'en')===0) {
                        echo 'Click to go back';
                    } else {
                        echo '点击返回';
                    }
                ?></div>
            </div>
        </a>
        <div class="snail">
            <div class="snail__head">
                <div class="snail__eye snail__eye--left"><span class="snail__pupil"></span></div><span class="snail__stx snail__stx--left"></span>
                <div class="snail__eye snail__eye--right"><span class="snail__pupil"></span></div><span class="snail__stx snail__stx--right"></span>
                <div class="snail__body-top">
                    <div class="snail__stom"></div>
                </div>
            </div>
            <div class="snail__body-bottom"></div>
            <div class="snail__body-caudatum"></div>
            <div class="snail__shell"></div>
        </div>
        <div class="text-content"><span>4</span><span>0</span><span>4</span></div>
    </div>
</body>

</html>
