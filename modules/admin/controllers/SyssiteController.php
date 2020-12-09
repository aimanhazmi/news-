<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\SysSite as SelfModel;
use app\modules\admin\service\SysSiteService as SelfService;

class SyssiteController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
    }

    /**
     * Created by lonisy@163.com
     * RESTful api
     * @param int $id
     * @return string
     */
    public function actionIndex($id = 0)
    {
        try {
            if (Yii::$app->request->isGet) {
                if ($id == 0) {
                    $data = SelfService::getInstance()->search($_GET);
                } else {
                    $data = SelfService::getInstance()->getModelById($id);
                }
            } else if (Yii::$app->request->isPost) {
                $data = SelfService::getInstance()->create($_POST);
            } else if (Yii::$app->request->isPatch) {
                $data = SelfService::getInstance()->patch($id);
            } else if (Yii::$app->request->isDelete) {
                $data = SelfService::getInstance()->deleteById($id);
            } else {
                return $this->responseApiError(100, '非法请求');
            }
        } catch (\Exception $e) {
            return $this->responseApiError(100, $e->getMessage());
        }
        return $this->responseApi($data);
    }

    /**
     * Created by lonisy@163.com
     * 批量操作 Batch operate
     * @return string
     */
    public function actionBatch()
    {
        try {
            if (Yii::$app->request->isPatch) {
                $data = SelfService::getInstance()->batchModify();
            } else if (Yii::$app->request->isDelete) {
                $data = SelfService::getInstance()->batchDelete();
            }
        } catch (\Exception $e) {
            return $this->responseApiError(100, $e->getMessage());
        }
        return $this->responseApi($data);
    }


    public function actionManage()
    {
        return $this->render($this->action->id, [
            'model' => new SelfModel(),
        ]);
    }

    public function actionNew()
    {
        $model = new SelfModel();
        return $this->render('modify', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id = 0)
    {
        if (!$id) {
            $id = 1;
//            return $this->redirect(['manage']);
        }
        return $this->render('modify', [
            'model' => SelfService::getInstance()->getModelById($id),
        ]);
    }

}
