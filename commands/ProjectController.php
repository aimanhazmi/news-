<?php

namespace app\commands;

use yii\data\Pagination as Paginolion;
use app\components\CommonToolkit;
use app\components\RedisToolkit;
use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

class ProjectController extends Controller
{
    public function actionStart()
    {
        echo 'hello';
    }
}
