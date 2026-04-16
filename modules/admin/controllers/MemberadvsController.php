<?php
/**
 * Created by aiman
 * User: aiman
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\MemberAdvs as SelfModel;
use app\modules\admin\service\MemberAdvsService as SelfService;
use app\modules\admin\service\ArticleService;

class MemberadvsController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
    }

    /**
     * Created by aiman
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
     * Created by aiman
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
        try {
            $adv_id = $_GET['adv_id'] ?? 0;
            if (!$adv_id) {
                throw new \Exception('错误的ID.');
            }
            $result = SelfService::getInstance()->search(['adv_id' => $adv_id], true);
            if (!empty($result['items'][0]['id'])) {
                return $this->actionEdit($result['items'][0]['id']);
            }
            $adv           = ArticleService::getInstance()->getModelById($adv_id);
            $model           = new SelfModel();
            $model->adv_id = $adv_id;
            return $this->render('modify', [
                'model' => $model,
                'adv' => $adv,
            ]);
        } catch (\Exception $e) {
            return $this->redirect(['manage']);
        }

    }

    public function actionEdit($id = 0)
    {
        try {
            if (!$id) {
                throw new \Exception('错误的ID.');
            }
            $model = SelfService::getInstance()->getModelById($id);
            $adv = ArticleService::getInstance()->getModelById($model->adv_id);
            return $this->render('modify', [
                'model' => $model,
                'adv' => $adv,
            ]);
        } catch (\Exception $e) {
            return $this->redirect(['manage']);
        }
    }

}
