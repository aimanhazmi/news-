<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/25
 * Time: 11:34
 */

namespace app\modules\admin\service;

use Yii;
use yii\data\Pagination as Paginolion;
use app\components\ArrayToolkit;
use app\modules\admin\models\SysSite as SelfModel;


class SysSiteService
{
    const MODEL_NAME = 'SysSite';

    public static $instance;

    public static function getInstance()
    {
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    /**
     * Created by aiman
     * 服务端分页
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {
        $model           = new SelfModel();
        $attributeLabels = $model->attributeLabels();
        $query           = $model->getActiveQuery($params);
        $searchWord      = $params['searchWord'] ?? false;
        if ($searchWord) {
            $query->andOnCondition(['like', SelfModel::PRIMARY_KEY, $searchWord]);
        }
        $pageNo     = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize   = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $paginolion = new Paginolion([
            'totalCount'    => $query->count(),
            'pageSizeParam' => false,
        ]);
        $paginolion->setPage($pageNo);
        $paginolion->setPageSize($pageSize > 100 ? 100 : $pageSize);
        if ($paginolion->getPageCount() < $paginolion->getPage() + 1) {
            throw new \Exception('没有更多数据了!');
        }
        if (isset($attributeLabels['sort'])) {
            $orderBy[] = 'sort DESC';
        }
        $orderBy[] = SelfModel::PRIMARY_KEY . ' DESC';
        $orderBy   = join(' , ', $orderBy);
        $items     = $query->offset($paginolion->offset)->limit($paginolion->limit)->orderBy($orderBy)->all();
        array_walk($items, function (&$item) {
            $item = $item->toArray();
            if (isset($item["status"])) {
                $item['enabled'] = $item["status"] == 1 ? true : false;
            }
            if (isset($item['created_at'])) {
                $item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
            }
            if (isset($item['updated_at'])) {
                $item['updated_at'] = date('Y-m-d H:i:s', $item['updated_at']);
            }
        });
        return $this->makeApiPagination($paginolion, $items);
    }

    /**
     * 生成 Api 分页方法
     * Created by aiman
     * @param Pagination $pagination
     * @param array      $items
     * @return mixed text-primary
     */
    public function makeApiPagination(\yii\data\Pagination $pagination, array $items = [])
    {
        $data['items']       = $items;
        $data['first']       = 1;
        $data['current']     = $pagination->page ? $pagination->page + 1 : 1;
        $data['before']      = $data['current'] > 1 ? $data['current'] - 1 : 1;
        $data['next']        = $data['current'] < $pagination->pageCount ? $data['current'] + 1 : $pagination->pageCount;
        $data['limit']       = count($items);
        $data['total_items'] = $pagination->totalCount + 0;
        $data['total_pages'] = $pagination->pageCount;
        return $data;
    }


    /**
     * Created by aiman
     * Description: 创建模型
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function create(array $data)
    {
        $model = new SelfModel();
        $model->load($data);
        $model->beforeCreate();
        if ($model->save() != true) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
        return $model->toArray([SelfModel::PRIMARY_KEY]);
    }


    /**
     * Created by aiman
     * Description: 更新模型
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function patch($id = 0, $params = [])
    {
        $data = !empty($params) ? $params : Yii::$app->request->getBodyParams();
        if (isset($data[self::MODEL_NAME])) {
            $data = $data[self::MODEL_NAME];
        }
        $id && $data[SelfModel::PRIMARY_KEY] = $id;
        if (!isset($data[SelfModel::PRIMARY_KEY])) {
            throw new \Exception('主键 ' . SelfModel::PRIMARY_KEY . ' 缺失!');
        }
        $model = $this->findModel($data[SelfModel::PRIMARY_KEY]);
        unset($data[SelfModel::PRIMARY_KEY]);
        $model->attributes = $data;
        // 支持排序
        if (isset($data['sortOperate'])) {
            if (!isset($model->sort)) {
                throw new \Exception('该业务无 sort 排序字段!');
            }
            $data['sortOperate'] == 'up' && $model->sort = $model->sort + 1;
            $data['sortOperate'] == 'down' && $model->sort = $model->sort - 1;
            if ($model->sort < 0) {
                $model->sort = 0;
            }
            unset($data['sortOperate']);
        }
        // 更改用户状态
        if (isset($data["changeStatus"])) {
            if (!isset($model->status)) {
                throw new \Exception('该业务无 status 状态字段!');
            }
            $model->status = $model->status == 1 ? 0 : 1;
            unset($data['changeStatus']);
        }
        // 多状态设置
        if (isset($data["field"])) {
            // $model->modifyField($data["field"]);
            unset($data["field"]);
        }
        $model->beforeUpdate();  // 更新钩子 如果有
        if ($model->save() == false) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
        return true;
    }

    /**
     * Created by aiman
     * 批量修改, 根据 ids 数组 修改指定字段
     */
    public function batchModify()
    {
        throw new \Exception('无法访问 您可能没有权限使用该功能!');
        $data = Yii::$app->request->getBodyParams();
        // 修改状态
        return true;
    }

    /**
     * Created by aiman
     * 批量删除
     */
    public function batchDelete()
    {
        throw new \Exception('无法访问 您可能没有权限使用该功能!');
        $data = Yii::$app->request->getBodyParams();
        if (isset($data['ids'][0])) {
            foreach ($data['ids'] as $id) {
                $this->findModel($id)->delete();
            }
        }
        return true;
    }

    public function deleteById(int $id = 0)
    {
        if ($id) {
            $model = $this->findModel($id);
            if (!$model) {
                throw new \Exception('该数据不存在!');
            } else {
                throw new \Exception('无法访问 您可能没有权限使用该功能!');
            }
            return $model->delete();
        }
        return true;
    }

    public function getModelById(int $id)
    {
        $model = $this->findModel($id);
        return $model;
    }

    public function findModel($id)
    {
        if (($model = SelfModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \Exception('该数据不存在.');
        }
    }
}