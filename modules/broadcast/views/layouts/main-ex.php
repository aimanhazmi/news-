<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-07
 * Time: 10:54
 */
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7;  IE=EDGE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $this->params['keywords'] ?? ''; ?>">
    <meta name="description" content="<?php echo $this->params['description'] ?? ''; ?>">
    <meta name="author" content="lonisy@163.com">
    <?= Html::csrfMetaTags() ?>
    <title><?php echo $this->params['title'] ?? ''; ?> - <?php echo $this->params['site_name'] ?? ''; ?></title>

    <link href="/static/broadcast/css/index.css" rel="stylesheet">
    <meta name="renderer" content="webkit">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <link href="/static/broadcast/css/common.css" rel="stylesheet">
    <link href="/static/broadcast/css/icon.min.css" rel="stylesheet">
    <script type="text/javascript" src="/static/broadcast/js/common.min.js"></script>
    <script type="text/javascript" src="/static/broadcast/js/main.min.js"></script>
    <script type="text/javascript" src="/static/broadcast/js/cp.min.js"></script>
    <script type="text/javascript" src="/static/broadcast/js/XDomainRequest.js"></script>
    <script async crossorigin="true" src="/static/broadcast/js/das.js"></script>

    <?php $this->head() ?>
</head>
<body data-spy="scroll" data-target="#navbar-example" style="position: relative;">
<div class="mobile-wrapper">
    <?php $this->beginBody() ?>
    <?php echo $this->render('header-ex') ?>
    <?php echo $content; ?>
    <?php echo $this->render('footer'); ?>
    <?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
