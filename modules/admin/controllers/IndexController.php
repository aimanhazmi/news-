<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\service\UserService;

/**
 * Default controller for the `admin` module
 */
class IndexController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {

        UserService::getInstance()->rememberLoginPassword();
        return $this->render('index');
    }
}
