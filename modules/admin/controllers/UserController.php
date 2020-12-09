<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\service\SysUsersService;
use Yii;
use yii\helpers\Url;

/**
 * Default controller for the `admin` module
 */
class UserController extends BaseController
{
    public function init()
    {
        $this->allowNoLogin = true;
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (Yii::$app->request->isPost) {
            try {
                $userinfo = SysUsersService::getInstance()->login($_REQUEST);
                $this->setUserSession($userinfo);
                if (isset($_REQUEST['remember_pwd']) && !empty($_REQUEST['remember_pwd'])) {
                    return $this->redirect(Url::to([Yii::$app->params['adminIndexUrl'], 'remember' => 'on']));
                }
                return $this->redirect(Url::to([Yii::$app->params['adminIndexUrl'], 'remember' => 'off']));
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('login_error', $e->getMessage());
            }
        }
        return $this->render($this->action->id);
    }


    public function actionLogout()
    {
        $this->unsetUserSession();
        $this->redirect(Url::to([Yii::$app->params['adminLoginUrl']]));
        return Yii::$app->end();
    }

    public function actionIsoffline()
    {
        if ($this->userIsOnline() == false) {
            $this->responseApi([
                'lockscreen_url' => Url::to([Yii::$app->params['adminLoginUrl']]),
            ]);
        }
        $this->responseApiError(1, 'online');
    }
}
