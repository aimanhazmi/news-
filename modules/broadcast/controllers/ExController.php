<?php
namespace  app\modules\broadcast\controllers;
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-07
 * Time: 10:34
 */

use yii\web\Controller;

class ExController extends BaseController
{
    public $layout = "main-ex";

    /**
     * 关于我们
    */
    public function actionAbout()
    {
        return $this->render("",[]);
    }

    /**
     * 注册
    */
    public function actionRegister()
    {
        $this->layout = "main-login";
        return $this->render("",[]);
    }

    /**
     * 登陆
    */
    public function actionLogin()
    {
        $this->layout = "main-login";
        return $this->render("",[]);
    }

    /**
     * 错误页面
    */
    public function actionError()
    {
        return $this->render('404',[]);
    }

}



