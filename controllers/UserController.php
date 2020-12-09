<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\service\UserService;

class UserController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionSign()
    {
        var_dump($_REQUEST);
        exit();
    }

}
