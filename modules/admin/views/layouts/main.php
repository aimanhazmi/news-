<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/24
 * Time: 11:45
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <title>网站管理后台 - <?php echo Yii::$app->params['siteInfo']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <?php echo Html::csrfMetaTags(); ?>
    <?php echo $this->render('public-css'); ?>
    <?php $this->head(); ?>

</head>
<body class="animated ng-scope static sidebar-icons">
<?php $this->beginBody(); ?>
<div>
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->

    <!--BEGIN TOPBAR-->
    <?php echo $this->render('page-header'); ?>
    <!--END TOPBAR-->

    <div id="wrapper">

        <!--BEGIN SIDEBAR MENU-->
        <?php echo $this->render('page-sidebar'); ?>
        <!--END SIDEBAR MENU-->

        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <!--BEGIN PAGE TITLE-->
            <?php if (isset($this->params['page-title-render'])): ?>
                <?php echo $this->render($this->params['page-title-render']); ?>
            <?php endif; ?>
            <!--END PAGE TITLE-->

            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <!--        --><?php // echo $this->render('page-breadcrumb'); ?>
            <!--END TITLE & BREADCRUMB PAGE-->
            <!--BEGIN CONTENT-->
            <div class="page-content">
                <?php echo $content; ?>
            </div>
            <!--END CONTENT-->
        </div>
        <!--BEGIN FOOTER-->

        <!--BEGIN FOOTER-->
        <?php echo $this->render('page-footer'); ?>

        <!--END FOOTER-->
    </div>
    <!--END PAGE WRAPPER-->
</div>
<?php echo $this->render('public-js'); ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
