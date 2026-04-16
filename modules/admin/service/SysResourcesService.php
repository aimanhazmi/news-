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
use app\modules\admin\models\SysResources as SelfModel;
use app\components\SidebarToolkit;

class SysResourcesService
{
    const MODEL_NAME = 'SysResources';

    public static $instance;

    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self();
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
        $model = new SelfModel();
        $items = $model->getResourcesTree($params);

        $pageNo     = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize   = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $paginolion = new Paginolion([
            'totalCount'    => count($items),
            'pageSizeParam' => false,
        ]);
        $paginolion->setPage($pageNo);
        $paginolion->setPageSize($pageSize > 100 ? 100 : $pageSize);
        array_walk($items, function(&$item) use ($model) {
            if (isset($item["status"])) {
                $item['enabled'] = $item["status"] == 1 ? true : false;
            }
            $item['icon']   = "<i class='{$item['icon']}'></i>";
            $item['type']   = $model->getFieldStatus('type', $item['type']);
            $item['target'] = $model->getFieldStatus('target', empty($item['target']) ? '_self' : $item['target']);
            $item['_show']  = $item['show'];
            $item['show']   = $model->getFieldStatus('show', $item['show']);
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
     * @param array $items
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


    public static function getLeftSidebar($params)
    {
        $activeItemsIds = [];
        if (isset($params['init-third-level']) && $params['init-third-level'] === true) {
            if (isset(Yii::$app->params['breadcrumbs'])) {
                $breadcrumbs                          = Yii::$app->params['breadcrumbs'];
                $endItem                              = end($breadcrumbs);
                $icon                                 = "<i class='{$endItem['icon']}'></i>";
                Yii::$app->params['breadcrumbs-path'] = $icon . ' ' . $endItem['name'];
                if (isset($breadcrumbs[2])) {
                    if ($endItem['show'] == 0) {
                        $activeItemsIds = array_column($breadcrumbs, 'id');
                        // to $item['active'] = true;
                    }
                }
            }
        }

        $leftSidebar = Yii::$app->getCache()->get('left_sidebar');
        $leftSidebar = false;
        if (!$leftSidebar) {
            $orderBy = 'sort DESC';

//            权限过滤
//            $session       = Yii::$app->session;
//            $accessActions = $session->get('accessActions');
//            $items         = SelfModel::find()->where(['status' => 1, 'position' => 1, 'show' => 1])->andWhere([
//                'in',
//                'id',
//                $accessActions
//            ])->orderBy($orderBy)->all();

            $items = SelfModel::find()->where(['status' => 1, 'position' => 1, 'show' => 1])->orderBy($orderBy)->all();

            if (isset($items[0])) {
                foreach ($items as $key => &$item) {
                    $item = $item->toArray();
                    $item = ArrayToolkit::parts($item, [
                        'id',
                        'name',
                        'action',
                        'identity',
                        'parent_id',
                        'target',
                        'sort',
                        'icon',
                        'show',
                    ]);
                    $item = ArrayToolkit::rename($item, [
                        'name' => 'label',
                    ]);


                    // TODO 这里可以输出权限列表
                    // file_put_contents('accessActions.txt', "'{$item['id']}'=>'{$item['label']}'," . PHP_EOL, FILE_APPEND);

                    $item['url'] = $item['action'];
                    empty($item['icon']) && $item['icon'] = 'glyphicon glyphicon-th-list';
                    $item['url']  = empty($item['url']) ? 'javascript:void(0)' : [$item['url']];
                    $item['sort'] = $item['sort'] + 0;
                    if (in_array($item['id'], $activeItemsIds)) {
                        $item['active'] = true;
                    }
                }
            }
            $leftSidebar = SidebarToolkit::makeTree($items, 'sort', 0, 'parent_id', 1);
            Yii::$app->getCache()->set('left_sidebar', $leftSidebar, 60 * 5);
        }
        return $leftSidebar;
    }

    public function getResourcesPathByAction($pathInfo = '')
    {
        $items = Yii::$app->getCache()->get('left_sidebar_data');
        if ($items === false || YII_ENV != 'prod') {
            $orderBy = 'sort DESC';
            $items   = SelfModel::find()->where(['status' => 1, 'position' => 1])->orderBy($orderBy)->all();
            foreach ($items as &$item) {
                $item = $item->toArray();
            }
            Yii::$app->getCache()->set('left_sidebar_data', $items, 60 * 60);
        }
        if (isset($items[0])) {
            $SelfClass      = new class
            {
                private function getResourcesByPathInfo($pathInfo, &$items)
                {
                    foreach ($items as $key => $item) {
                        if ($item['action'] == $pathInfo) {
                            unset($items[$key]);
                            return $item;
                        }
                    }
                    return false;
                }

                private function getResourcesById($id, &$items)
                {
                    foreach ($items as $key => $item) {
                        if ($item['id'] == $id) {
                            unset($items[$key]);
                            return $item;
                        }
                    }
                    return false;
                }

                public function getPathArray($pathInfo = '', $id = 0, $items, $pathArray = [])
                {
                    if (!empty($pathInfo)) {
                        $resource = $this->getResourcesByPathInfo($pathInfo, $items);
                        if ($resource) {
                            array_unshift($pathArray, $resource);
                        }
                    }
                    if ($id > 0) {
                        $resource = $this->getResourcesById($id, $items);
                        if ($resource) {
                            array_unshift($pathArray, $resource);
                        }
                    }
                    if (isset($resource['parent_id'])) {
                        $pathArray = $this->getPathArray('', $resource['parent_id'], $items, $pathArray);
                    }
                    return $pathArray;
                }
            };
            $resourcesClass = new $SelfClass();
            return $resourcesClass->getPathArray($pathInfo, 0, $items);
        }
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
            //$model->modifyField($data["field"]);
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
                $children = SelfModel::find()->where(['parent_id' => $model->id])->all();
                if (count($children)) {
                    foreach ($children as $child) {
                        $this->deleteById($child->id);
                    }
                }
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