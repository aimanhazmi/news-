<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/4/28
 * Time: 12:00
 */
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AdminAsset;


$showFlag = date('d') % 2;
if ($showFlag) {
    AdminAsset::set('3D-lines-animation.bundle', $this);
} else {
    AdminAsset::set('Galaxy-canvas.bundle', $this);
}
$cookie = Yii::$app->request->cookies;
//$cookie->has('login_remember');			//判断cookie是否存在
//$cookie->get('name');			//get()方法读取cookie
//$cookie->getValue('name');		//getValue()方法读取cookie

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>登录</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="cache-control" content="no-cache">
        <!--    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">-->
        <!--Loading bootstrap css-->
                
        <link type="text/css" rel="stylesheet" href="/static/vendors/googleapis/css/font-1.css">
        <link type="text/css" rel="stylesheet" href="/static/vendors/googleapis/css/font-2.css">


        <link type="text/css" rel="stylesheet"
              href="/static/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
        <link type="text/css" rel="stylesheet" href="/static/vendors/font-awesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/static/vendors/bootstrap/css/bootstrap.min.css">
        <!--Loading style vendors-->
        <link type="text/css" rel="stylesheet" href="/static/vendors/animate.css/animate.css">
        <link type="text/css" rel="stylesheet" href="/static/vendors/iCheck/skins/all.css">
        <!--Loading style-->
        <link type="text/css" rel="stylesheet" href="/static/css/themes/style1/pink-blue.css" class="default-style">
        <link type="text/css" rel="stylesheet" href="/static/css/themes/style1/pink-blue.css" id="theme-change"
              class="style-change color-change">
        <link type="text/css" rel="stylesheet" href="/static/css/style-responsive.css">
        <link rel="shortcut icon" href="/static/images/favicon.ico">
        <style>
            .canvas-wrap {
                position: relative;
            }

            div.canvas-content {
                position: relative;
                z-index: 2000;
                color: #fff;
                text-align: center;
                padding-top: 30px;
            }

            #canvas {
                width: 100%;
                overflow: hidden;
                position: absolute;
                top: 0;
                left: 0;
                background-color: #1a1724;
            }

            .page-form {
                background-color: rgba(0, 0, 0, 0.2);
            }

            .page-form .header-content {
                background-color: unset;
            }

            .header-title {
                -webkit-animation-name: jobalert;
                -webkit-animation-duration: 2s;
                -webkit-animation-direction: alternate;
                -webkit-animation-iteration-count: infinite;
                animation-name: jobalert;
                animation-duration: 2s;
                animation-direction: alternate;
                animation-iteration-count: infinite;
            }
        </style>
    </head>

    <body id="signin-page-1">
    <?php $this->beginBody(); ?>
    <section class="canvas-wrap">
        <div class="canvas-content">
            <div class="page-form">
                <form action="<?php echo Url::to(); ?>" class="form" method="POST">
                    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf"/>
                    <div class="header-content">
                        <h1 class="header-title animate">登录</h1>
                    </div>
                    <div class="body-content">
                        <div class="form-group">
                            <div class="input-icon right"><i class="fa fa-user"></i>
                                <input type="text" placeholder="登录名/手机号/QQ" name="login_name" class="form-control"
                                       value="<?php echo $cookie->get('login_name'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon right"><i class="fa fa-key"></i>
                                <!-- for disable autocomplete on chrome -->
                                <input type="password" placeholder="密码" name="login_pwd" class="form-control"
                                       value="<?php echo $cookie->get('login_pwd'); ?>" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group pull-left">
                            <div class="checkbox-list">
                                <label>
                                <?php if ($cookie->has('login_remember')): ?>
                                    <input type="checkbox" name="remember_pwd" value="on" checked>&nbsp; 记住登录</label>
                                <?php else: ?>
                                    <input type="checkbox" name="remember_pwd">&nbsp; 记住登录</label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-success">登录 &nbsp;
                                <i class="fa fa-chevron-circle-right"></i>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <?php if (Yii::$app->session->hasFlash('login_error')): ?>
                            <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('login_error'); ?></div>
                        <?php endif; ?>

                        <!--            <div class="forget-password">-->
                        <!--                <h4>Forgotten your Password?</h4>-->
                        <!--                <p>no worries, click <a href='#' class='btn-forgot-pwd'>here</a> to reset your password.</p>-->
                        <!--            </div>-->
                        <hr>
                        <p>如没有开通账号，请联系管理员注册！</p>
                    </div>
                </form>

            </div>
        </div>
        <?php if ($showFlag): ?>
            <div id="canvas" class="gradient" data-alt="3D-lines-animation"></div>
        <?php else: ?>
            <canvas id="canvas" data-alt="Galaxy-canvas"></canvas>
        <?php endif; ?>
    </section>
    <script src="/static/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/static/js/jquery-ui.js"></script>
    <!--loading bootstrap js-->
    <script src="/static/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
    <script src="/static/js/html5shiv.js"></script>
    <script src="/static/js/respond.min.js"></script>
    <script src="/static/vendors/iCheck/icheck.min.js"></script>
    <script src="/static/vendors/iCheck/custom.min.js"></script>
    <script>
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            increaseArea: '20%' // optional
        });
        $('input[type="radio"]').iCheck({
            radioClass: 'iradio_minimal-grey',
            increaseArea: '20%' // optional
        });
    </script>
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage() ?>
