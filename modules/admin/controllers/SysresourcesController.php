<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\SysResources as SelfModel;
use app\modules\admin\service\SysResourcesService as SelfService;
use app\components\ArrayToolkit;
use app\components\SysSidebar;

class SysresourcesController extends BaseController
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
        $model       = new SelfModel();
        $model->icon = 'fa fa-th-list fa-fw';
        return $this->render('modify', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id = 0)
    {
        if (!$id) {
            return $this->redirect(['manage']);
        }
        return $this->render('modify', [
            'model' => SelfService::getInstance()->getModelById($id),
        ]);
    }

    public function actionInitdata()
    {
        // 该代码不可用于生产上
        $data = SysSidebar::getList();
        if (isset($_GET['init'])) {
            // 递归入库菜单数据
            $this->recursionSave($data);
        }
        return $this->redirect(['manage']);
    }

    private function recursionSave($data = [], $pid = 0)
    {
        foreach ($data as $item) {
            $item['parent_id'] = $pid;
            $item['pathinfo']  = trim($item['pathinfo'], '/');
            $item['pathinfo']  = str_replace('.html', '', $item['pathinfo']);
            unset($item['type']);
            $result = SelfService::getInstance()->create(['SysResources' => ArrayToolkit::rename($item, [
                'title'      => 'name',
                'icon_class' => 'icon',
                'target'     => 'target',
                'pathinfo'   => 'action',
            ])]);
            if (isset($item['children'])) {
                $this->recursionSave($item['children'], array_pop($result));
            }
        }
    }

    public function actionTest()
    {
        return $this->render($this->action->id);

    }
}
