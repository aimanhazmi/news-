<?php
$this->context->layout = false;
use yii\helpers\Url;
?>
<html>

<head>
    <meta charset="utf-8">
    <title>404</title>
    <meta name="keywords" content="金融软件定制,软件开发,金融软件开发,金融软件,系统开发,金融科技">
    <meta name="description" content="致力于系统开发,金融软件,金融科技,金融系统开发等业务，是业界有名的软件开发公司和金融软件解决方案提供商,5年丰富的金融软件定制开发经验,300家客户的见证信赖与选择！">
    <link href="/static/broadcast/css//index./static/broadcast/css/" rel="stylesheet">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    
    <link href="/static/broadcast/css/404.css" rel="stylesheet">

    <link href="/static/broadcast/css/login.css" rel="stylesheet">
    <script type="text/javascript" src="/static/broadcast/js/common.min.js"></script>
    <script type="text/javascript" src="/static/broadcast/js/cp.min.js"></script>
    <script type="text/javascript" src="/static/broadcast/js/XDomainRequest.js"></script>
    <script async crossorigin="true" src="/static/broadcast/js/das.js"></script>
</head>

<body>
    <div class="misspage-layer">
        <div class="main-wrap clearfix">
            <div class="misspage-content">
                <img width="320" src="/static/broadcast/images//404.png">
                <div class="black">抱歉 找不到原来的页面了。</div>
                <div>您所访问的页面不存在或者已经下线。给您带来的不便敬请谅解。</div>
                <a class="misspage-btn" href="<?php echo Url::to("/"); ?>">返回官网 &gt;</a>
            </div>
        </div>
    </div>
    
</body>

</html>