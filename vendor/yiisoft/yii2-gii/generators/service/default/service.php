<?php
/* @var $generator yii\gii\generators\service\Generator */
echo "<?php\n" ?>
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/25
 * Time: 11:34
 */

namespace app\mechanise\service;

use app\mechanise\models\<?= $generator->selfModel ?> as SelfModel;
use app\service\<?= $generator->originalService ?> as OriginalService;

use app\components\ArrayToolkit;
use Yii;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class <?= $generator->name?>Service extends OriginalService
{
    const MODEL_NAME = '<?=$generator->selfModel ?>';

    /**
     * Created by lonisy@163.com
     * 服务端分页
     * @param array $params
     * @return mixed
     */
    public static function search($params = array())
    {
        // isset($params['type']) && $where['type'] = intval($params['type']);
        // isset($params['game_type']) && $where['game_type'] = intval($params['game_type']);
        $where = [];
        $query = SelfModel::find()->where($where)->orderBy(SelfModel::PRIMARY_KEY . ' DESC');

        // 默认每页条数
        $pageNo     = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize   = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $pagination = new Pagination([
            'totalCount'    => $query->count(),
            'pageSizeParam' => false,
        ]);
        $pagination->setPage($pageNo);
        $pagination->setPageSize($pageSize > 100 ? 100 : $pageSize);
        if ($pagination->getPageCount() < $pagination->getPage() + 1) {
            throw new \Exception('没有更多数据了!');
        }
        $items = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        array_walk($items, function (&$item) {
            $item            = $item->toArray();
            $item['enabled'] = $item["status"] == 1 ? true : false;
        });
        return static::makeApiPagination($pagination, $items);
    }

    /**
     * 生成 Api 分页方法
     * Created by lonisy@163.com
     * @param Pagination $pagination
     * @param array $items
     * @return mixed text-primary
     */
    public static function makeApiPagination(\yii\data\Pagination $pagination, array $items = [])
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


    public static function create(array $data)
    {
        $model = new SelfModel();
        $model->load($data);
        $model->beforeCreate();
        if ($model->save() != true) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
        return $model->toArray(['id']);
    }

    /**
     * Created by lonisy@163.com
     * 批量修改, 根据 ids 数组 修改指定字段
     */
    public static function batchModify()
    {
        $data = Yii::$app->request->getBodyParams();
        // 修改状态
        return true;
    }

    /**
     * Created by lonisy@163.com
     * 批量删除
     */
    public static function batchDelete()
    {
        throw new \Exception('非法操作.');
        $data = Yii::$app->request->getBodyParams();
        if (isset($data['ids'][0])) {
            foreach ($data['ids'] as $id) {
                static::findModel($id)->delete();
            }
        }
        return true;
    }

    public static function patch($id = 0)
    {
        $data = Yii::$app->request->getBodyParams();

        // TODO 这里是?
        //提取yii2 提交的data
        $tmp       = explode('\\', SelfModel::className());
        $className = $tmp[count($tmp) - 1];
        if (isset($data[$className])) {
            $data = $data[$className];
        }
        //

        if (isset($data[self::MODEL_NAME])) {
            $data = $data[self::MODEL_NAME];
        }

        $id && $data[SelfModel::PRIMARY_KEY] = $id;

        if (!isset($data[SelfModel::PRIMARY_KEY])) {
            throw new \Exception('主键 ID 缺失!');
        }

        $model = static::findModel($data[SelfModel::PRIMARY_KEY]);

        unset($data[SelfModel::PRIMARY_KEY]);

        // 支持排序
        if (isset($data['sortOperate'])) {
            $data['sortOperate'] == 'up' && $model->sort = $model->sort + 1;
            $data['sortOperate'] == 'down' && $model->sort = $model->sort - 1;
            unset($data['sortOperate']);
        }

        // 更改用户状态
        if (isset($data["changeStatus"])) {
            $model->status = $model->status == 1 ? 0 : 1;
            unset($data['changeStatus']);
        }

        // 多状态设置
        if (isset($data["field"])) {
            $model->modifyField($data["field"]);
            unset($data["field"]);
        }

        foreach ($data as $key => $val) {
            $model->{$key} = $val;
        }

        $model->beforeUpdate();  // 更新钩子 如果有

        if ($model->save() == false) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
        return true;
    }

    public static function deleteById(int $id = 0)
    {
        if ($id) {
            throw new \Exception('该数据不存在.');
            return static::findModel($id)->delete();
        }
        return true;
    }

    public static function getModelById(int $id)
    {
        $model = static::findModel($id);
        return $model;
    }

    public static function findModel($id)
    {
        if (($model = SelfModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \Exception('该数据不存在.');
        }
    }
}