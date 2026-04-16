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
use app\components\RedisToolkit;
use app\modules\admin\models\SysUsers as SelfModel;


class SysUsersService
{
    const MODEL_NAME = 'SysUsers';

    public static $instance;

    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

    public function login(array $params = [])
    {
        $params = array_filter($params);
        if (isset($params['mobile'])) {
            $paramsKeys = ['mobile', 'login_pwd'];
        } else if (isset($params['login_name'])) {
            $paramsKeys = ['login_name', 'login_pwd'];
        } else {
            throw new \Exception("缺失 mobile 参数! ");
        }
        foreach ($paramsKeys as $paramsKey) {
            if (!isset($params[$paramsKey])) {
                throw new \Exception("缺失 $paramsKey 参数! ");
            }
        }
        $where = ArrayToolkit::parts($params, ['login_name', 'mobile']);
        $user = SelfModel::find()->where($where)->one();
        if (!$user) {
            if (isset($params['mobile'])) {
                throw new \Exception("该手机号未注册！");
            }
            if (isset($params['login_name'])) {
                throw new \Exception("用户不存在！");
            }
        }
        if ($params['login_pwd'] != $user->login_pwd) {
            if (password_verify($params['login_pwd'], $user->login_pwd) == false) {
                throw new \Exception("密码错误！");
            }
        }
        return $user;
    }


    /**
     * Created by aiman
     * 服务端分页
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {
        if (isset($params['source_register_analysis'])) {
            return $this->sourceRegisterAnalysis($params);
        }

        if (isset($params['myclient_results'])) {
            return $this->getMyClientResults($params);
        }

        /* @var $redis \Redis(); */
        $redis = RedisToolkit::getInstance();
        if (isset($params['status']) && $params['status'] == 3) {
            unset($params['status']);
            $searchBannedData = true;
        }

        $model           = new SelfModel();
        $attributeLabels = $model->attributeLabels();

        /* @var $query yii\db\ActiveQuery */
        $query           = $model->getActiveQuery($params);
        $searchWord      = $params['searchWord'] ?? false;
        if ($searchWord) {
            $query->andOnCondition([
                'like',
                SelfModel::PRIMARY_KEY,
                $searchWord
            ]);
            $query->orOnCondition([
                'like',
                'visitor_identity',
                $searchWord
            ]);
            $query->orOnCondition([
                'like',
                'login_name',
                $searchWord
            ]);
            $query->orOnCondition([
                'like',
                'nickname',
                $searchWord
            ]);
        }
        $pageNo      = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize    = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $maxPageSize = 100;


        $paginolion = new Paginolion([
            'totalCount'    => $query->count(),
            'pageSizeParam' => false,
        ]);
        $paginolion->setPage($pageNo);
        $paginolion->setPageSize($pageSize > $maxPageSize ? $maxPageSize : $pageSize);
        if ($paginolion->getPageCount() < $paginolion->getPage() + 1) {
            throw new \Exception('没有更多数据了!');
        }
        if (isset($attributeLabels['sort'])) {
            $orderBy[] = 'sort DESC';
        }
        $orderBy[] = SelfModel::PRIMARY_KEY . ' DESC';
        $orderBy   = join(' , ', $orderBy);
        $items     = $query->offset($paginolion->offset)->limit($paginolion->limit)->orderBy($orderBy)->all();

        array_walk($items, function(&$item) use ($model) {
            $item = $item->toArray();
            if (!empty($item['visitor_identity'])) {
                $visitor_name_hash = $item['visitor_identity'];
            } else {
                $visitor_name_hash = md5($item['login_pwd']);
            }
            $item['visitor_name'] = '游客_' . strtoupper(substr($visitor_name_hash, 0, 4));
            if (isset($item["status"])) {
                $item['enabled'] = $item["status"] == 1 ? true : false;
            }
            $item['from_user'] = '未分配';
            if ($item['from_user_id'] > 0) {
                $from_user = SelfModel::findOne($item['from_user_id']);
                if ($from_user) {
                    $item['from_user'] = $from_user->nickname;
                }
            }
            $item["vip"]    = $model->getFieldStatus('vip', $item["vip"]);
            $item["sex"]    = $model->getFieldStatus('sex', $item["sex"]);
            $item["status"] = $model->getFieldStatus('status', $item["status"]);
            if (isset($item['created_at'])) {
                $item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
            }
            if (isset($item['last_access_time']) && $item['last_access_time'] > 0) {
                $item['last_access_time'] = date('Y-m-d H:i:s', $item['last_access_time']);
            } else {
                $item['last_access_time'] = '-';
            }
            if (isset($item['updated_at'])) {
                $item['updated_at'] = date('Y-m-d H:i', $item['updated_at']);
            }
            if (empty($item['referer_domain']) && !empty($item['referer'])) {
                $item['referer_domain'] = parse_url($item['referer'], PHP_URL_HOST);
            }
            $item['_referer'] = $item['referer'];
            $item['referer']  = substr($item['referer'], 0, 20) . '...';
            if (!empty($item['referer_keywords'])) {
                $item['referer_keywords'] = mb_substr($item['referer_keywords'], 0, 10);
            }
            if (!empty($item["referer_domain"])) {
                $item["referer_name"] = $model->getFieldStatus('referer_name', $item["referer_domain"], '-');
                $item["channel"]      = $model->getFieldStatus('channel', $item["referer_domain"], '-');
            } else {
                $item["referer_name"] = '-';
            }
            array_walk($item, function(&$val) {
                if ($val === '') {
                    $val = '-';
                }
            });
        });
        return $this->makeApiPagination($paginolion, $items);
    }

    public function getMyClientResults($params)
    {
        if (isset($params['myclient_results'])) {
            unset($params['myclient_results']);
        }
        if (isset($params['from_user_id'])){
            $where = "from_user_id = '{$params['from_user_id']}' AND";
        }else{
            $where = '';
        }
        $items = SelfModel::find()->select([
            "FROM_UNIXTIME( created_at, '%Y-%m-%d' ) days",
            "SUM( CASE role WHEN 'visitor' THEN 1 ELSE 0 END ) visitor_total",
            "SUM( CASE role WHEN 'client' THEN 1 ELSE 0 END ) client_total",
        ])->where("$where created_at >  UNIX_TIMESTAMP(DATE_ADD(CURDATE(),INTERVAL -2 MONTH))")->groupBy('days')->orderBy('days DESC')->asArray()->all();
        $pageNo     = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize   = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $paginolion = new Paginolion([
            'totalCount'    => count($items),
            'pageSizeParam' => false,
        ]);
        $paginolion->setPage($pageNo);
        $paginolion->setPageSize($pageSize > 100 ? 100 : $pageSize);
        if ($paginolion->getPageCount() < $paginolion->getPage() + 1) {
            throw new \Exception('没有更多数据了!');
        }
        return $this->makeApiPagination($paginolion, $items);
    }

    public function sourceRegisterAnalysis($params)
    {
        if (isset($params['source_register_analysis'])) {
            unset($params['source_register_analysis']);
        }
        // TODO 加上注册条件
        $items = SelfModel::find()->select([
            'referer_domain',
            'count(*) as register_num'
        ])->groupBy('referer_domain')->orderBy('register_num DESC')->asArray()->all();

        $pageNo     = isset($params['page_no']) ? intval($params['page_no'] - 1) : 0;
        $pageSize   = isset($params['page_size']) ? intval($params['page_size']) : 10;
        $paginolion = new Paginolion([
            'totalCount'    => count($items),
            'pageSizeParam' => false,
        ]);
        $paginolion->setPage($pageNo);
        $paginolion->setPageSize($pageSize > 100 ? 100 : $pageSize);
        if ($paginolion->getPageCount() < $paginolion->getPage() + 1) {
            throw new \Exception('没有更多数据了!');
        }
        $model = new SelfModel();
        array_walk($items, function(&$item) use ($model) {
            if (!empty($item["referer_domain"])) {
                $item["referer_name"] = $model->getFieldStatus('referer_name', $item["referer_domain"], '-');
            } else {
                $item["referer_name"] = '未分类';
            }
            array_walk($item, function(&$val) {
                if (empty($val)) {
                    $val = '-';
                }
            });
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
        if (isset($data['SysUsers']['login_pwd']) && !empty($data['SysUsers']['login_pwd'])) {
            $data['SysUsers']['login_pwd'] = password_hash($data['SysUsers']['login_pwd'], PASSWORD_DEFAULT);
        }
        $scenarioscenario = Yii::$app->params['model']['scenario'] ?? '';
        if (!empty($scenario)) {
            $model->scenario = $scenario;
        }
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

        // 更新密码
        if (isset($data['login_pwd']) && $model->login_pwd != $data['login_pwd']) {
            $data['login_pwd'] = password_hash($data['login_pwd'], PASSWORD_DEFAULT);
        }
        $scenario = Yii::$app->params['model']['scenario'] ?? '';
        if (!empty($scenario)) {
            $model->scenario = $scenario;
        }
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

    /**
     * Created by aiman <ammzz2020@gmail.com>
     * getOnlineAnalysis 2018/8/14
     * 获取在线人数
     * @return array
     */
    public function getOnlineAnalysis()
    {
        $redis         = RedisToolkit::getInstance();
        $patternResult = $redis->keys('*online*');
        $users         = [];
        if (isset($patternResult[0])) {

            foreach ($patternResult as $item) {
                $token = $redis->get(str_replace('easyim:', '', $item));
                if ($token) {
                    $user_info = $redis->hGetAll('user_info:token:' . $token);
                    if (is_array($user_info) && !empty($user_info)) {
                        $users[] = $user_info;
                    }
                }
            }
        }
        $roleRelated    = [
            'admin'     => '管理员',
            'teacher'   => '讲师',
            'anchor'    => '主播',
            'assistant' => '助理',
            'robot'     => '机器人',
            'client'    => '客户',
            'visitor'   => '访客',
        ];
        $onlineAnalysis = [];
        if (isset($users[0])) {
            array_walk($users, function($user) use (&$onlineAnalysis) {
                if (isset($user['role'])) {
                    $onlineAnalysis[$user['role']] = ($onlineAnalysis[$user['role']] ?? 0) + 1;
                }
            });
        }
        $AnalysisData = [
            '机器人' => 1,
            '管理员' => 1,
        ];
        if (count($onlineAnalysis)) {
            foreach ($onlineAnalysis as $key => $item) {
                if (isset($roleRelated[$key])) {
                    $AnalysisData[$roleRelated[$key]] = $item;
                }
            }
        }
        arsort($AnalysisData);
        return $AnalysisData;
    }

    /**
     * Created by aiman <ammzz2020@gmail.com>
     * 查询七天注册曲线 2018/8/14
     * @return array
     */
    public function get7DayRegAnalysis()
    {
        $addDaysSqlString[] = 'SELECT curdate() as tmp_date';
        for ($i = 1; $i < 15; $i++) {
            $addDaysSqlString[] = "SELECT date_sub(curdate(), interval $i day) as tmp_date";
        }
        $addDaysSqlString = join(' union all ', $addDaysSqlString);

        $sql
                = "select a.tmp_date as date,ifnull(b.num,0) as num
            from (
                " . $addDaysSqlString . "
            ) a left join (
            select count(*) as num, date(FROM_UNIXTIME(created_at)) as date from sys_users where datediff(now(),FROM_UNIXTIME(created_at)) < 7 AND role = 'client'  group by day(FROM_UNIXTIME(created_at))
            ) b on a.tmp_date = b.date
            ORDER BY a.tmp_date";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if (is_array($result) && count($result)) {
            foreach ($result as &$item) {
                if (isset($item['date'])) {
                    $item['date'] = date('m-d', strtotime($item['date']));
                }
            }
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Created by aiman <ammzz2020@gmail.com>
     * 查询七天 IP 曲线 2018/8/14
     */
    public function get7DayIpAnalysis()
    {
        $addDaysSqlString[] = 'SELECT curdate() as tmp_date';
        for ($i = 1; $i < 15; $i++) {
            $addDaysSqlString[] = "SELECT date_sub(curdate(), interval $i day) as tmp_date";
        }
        $addDaysSqlString = join(' union all ', $addDaysSqlString);

        $sql
                = "select a.tmp_date as date,ifnull(b.num,0) as num
            from (
               " . $addDaysSqlString . "
            ) a left join (
            select count(*) as num, date(FROM_UNIXTIME(created_at)) as date from itv_users where datediff(now(),FROM_UNIXTIME(created_at)) < 7 group by day(FROM_UNIXTIME(created_at))
            ) b on a.tmp_date = b.date
            ORDER BY a.tmp_date";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if (is_array($result) && count($result)) {
            foreach ($result as &$item) {
                if (isset($item['date'])) {
                    $item['date'] = date('m-d', strtotime($item['date']));
                }
            }
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Created by aiman <ammzz2020@gmail.com>
     * 获取用户统计数据 2018/8/14
     * @return array
     */
    public function getUserAnalysis()
    {
        $sql
                = "SELECT 
                    SUM(CASE WHEN role = 'visitor' THEN 1 ELSE 0 END) as 总访客,
                    SUM(CASE WHEN role = 'visitor' AND created_at > UNIX_TIMESTAMP(DATE_FORMAT(now(), '%Y-%m-%d 00:00:00'))  THEN 1 ELSE 0 END) as 今日访客,
                    SUM(CASE WHEN role = 'client' THEN 1 ELSE 0 END) as 总客户,
                    SUM(CASE WHEN role = 'client' AND created_at > UNIX_TIMESTAMP(DATE_FORMAT(now(), '%Y-%m-%d 00:00:00'))  THEN 1 ELSE 0 END) as 今日注册客户
                FROM sys_users";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result[0] ?? [];
    }
}
