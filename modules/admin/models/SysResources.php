<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "sys_resources".
 * @property string  id
 * @property string  parent_id
 * @property string  name
 * @property string  identity
 * @property string  subhead
 * @property string  alias
 * @property string  description
 * @property integer type
 * @property integer position
 * @property integer star
 * @property string  icon
 * @property string  label
 * @property string  target
 * @property string  action
 * @property string  url
 * @property string  extend_info
 * @property string  extend_data
 * @property integer sort
 * @property integer show
 * @property integer status
 * @property integer created_at
 * @property integer updated_at
 */
class SysResources extends \yii\db\ActiveRecord
{
    const PRIMARY_KEY = 'id';

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => time(),
            ],
        ];
    }

    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    public static function tableName()
    {
        return 'sys_resources';
    }

    public function rules()
    {
        return [
            [['parent_id', 'type', 'position', 'star', 'sort', 'show', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'identity', 'subhead', 'alias', 'description', 'icon', 'label', 'target', 'action', 'url'], 'string', 'max' => 255],
            [['extend_info'], 'string', 'max' => 2000],
            [['extend_data'], 'string', 'max' => 5000],
            [['identity'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => '主键ID',
            'parent_id'   => '上级资源ID',
            'name'        => '资源名',
            'identity'    => '资源唯一标识',
            'subhead'     => '副标题',
            'alias'       => '别名',
            'description' => '描述',
            'type'        => '类型', //  0=>模块; 1=>菜单; 2=>按钮; 3=>数据; 4=>文件; 5=>维度;,
            'position'    => '显示位置', //  0=>顶部; 1=>左侧; 2=>右侧; 3=>底部;,
            'star'        => '星级', //  1=>一星; 2=>二星; 3=>三星; 4=>四星; 5=>五星;,
            'icon'        => '图标',
            'label'       => '标签',
            'target'      => '打开方式',
            'action'      => '控制器名',
            'url'         => '访问地址',
            'extend_info' => '扩展参数',
            'extend_data' => '扩展数据',
            'sort'        => '排序', //数字越大顺序越靠后,同数字,id在前的先显示
            'show'        => '展示', //  0=>不展示; 1=>展示,
            'status'      => '状态', //  0=>禁用; 1=>启用,
            'created_at'  => '创建时间戳',
            'updated_at'  => '更新时间戳',
        ];
    }

    public function getManageTableHead()
    {
        return [
            'grade_name' => ['comment' => '资源名称'],
            // 'name'        => ['comment' => '资源名称'],
            // 'identity'    => ['comment' => '资源唯一标识'],
            // 'subhead'     => ['comment' => '副标题'],
            // 'alias'       => ['comment' => '别名'],
            // 'description' => ['comment' => '描述'],
            'icon'       => ['comment' => '图标'],
            'type'       => ['comment' => '类型'],
            // 'position'    => ['comment' => '显示位置'],
            // 'star'        => ['comment' => '星级'],
            // 'label'       => ['comment' => '标签'],
            'target'     => ['comment' => '打开方式'],
            // 'action'      => ['comment' => '控制器名'],
            // 'url'         => ['comment' => '访问地址'],
            // 'extend_info' => ['comment' => '扩展参数'],
            // 'extend_data' => ['comment' => '扩展数据'],
            'show'       => ['comment' => '展示'],
            'sort'       => ['comment' => '排序数值'],
            // 'status'      => ['comment' => '状态'],
            // 'created_at'  => ['comment' => '创建时间戳'],
            // 'updated_at'  => ['comment' => '更新时间戳'],
        ];
    }

    public function getResourcesTree($params = [])
    {
        $orderBy = 'sort DESC';
        $where   = ['status' => 1];
        if (isset($params['parent_id'])) {
            $where['parent_id'] = $params['parent_id'] + 0;
        }
        $model      = parent::find()->where($where);
        $searchWord = $params['searchWord'] ?? '';
        if (!empty($searchWord)) {
            $searchWord = trim($searchWord);
            $model->where(['like', 'name', $searchWord]);
        }
        $categorys = $model->orderBy($orderBy)->all();
        foreach ($categorys as &$category) {
            $category = $category->toArray();
        }
        if (!isset($where['parent_id']) && empty($searchWord)) {
            $categorys = $this->makeTree($categorys);
            $test      = 'unset';
            $this->makeTree($test); //重置静态变量
            foreach ($categorys as $key => &$val) {
                $val['grade_name'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $val['grade']) . "|-" . $val['name'];
            }
            unset($category);
        } else {
            array_walk($categorys, function (&$category) {
                $category['grade_name'] = $category['name'];
            });
        }
        return $categorys;
    }

    /**
     * Created by lonisy@163.com
     * 页面查询过滤规则
     * 时间区间查询 timeRange
     * 日期区间查询 dateRange
     * 快速日期区间查询 quickDateRange
     * 字段精确查询 field
     * 单选项查询 selects
     * 多选项 multipleSelects // 默认显示选择数量
     * 多选项-选项可检索 liveSearch
     */
    public function getSearchfilterRules()
    {
        return [
            [
                'type'       => 'searchSelect',
                'attributes' => [
                    'data-size' => 8,
                ],
                'field'      => 'parent_id',
                'name'       => '上级菜单',
                'default'    => '',
                //                'listData'   => [],
                'listData'   => $this->getFieldStatusData('parent_id'),
            ],
        ];
    }

    public function getActiveQuery(array $params = [])
    {
        $query = Yii::createObject(ActiveQuery::className(), [get_called_class()]);
        foreach ($params as $field => $value) {
            foreach ($this->getSearchfilterRules() as $rule) {
                if ($rule["field"] == $field) {
                    switch ($rule["type"]) {
                        case "date-range":
                            $startDate = strtotime($value["start_date"]) ? strtotime($value["start_date"]) : false;
                            $endDate   = strtotime($value["end_date"]) ? strtotime($value["end_date"]) : false;
                            if ($startDate && $endDate) {
                                $query->andOnCondition(['between', $field, $startDate, $endDate]);
                            }
                            break;
                        case "field":
                            if ($value !== '') {
                                $query->andOnCondition(['like', $field, $value]);
                            }
                            break;
                        case "select":
                            if ($value !== '') {
                                $query->andOnCondition([$field => $value]);
                            }
                            break;
                        case "search-select":
                            if ($value !== '') {
                                $query->andOnCondition([$field => $value]);
                            }
                            break;
                        case "multiple-select":
                            if (!empty($value)) {
                                $query->andOnCondition(['in', $field, $value]);
                            }
                            break;
                    }
                }
            }
        }
        return $query;
    }

    public function getFormFields()
    {
        return [
            'parent_id'   => ['type' => 'liveSearch', 'data-size' => 8, 'data' => $this->getFieldStatusData("parent_id")],
            'name'        => ['type' => 'text', 'require' => true],
            'type'        => ['type' => 'radio', 'data' => $this->getFieldStatusData("type")],
            'position'    => ['type' => 'radio', 'data' => $this->getFieldStatusData("position")],
            'action'      => ['type' => 'text'],
            'target'      => ['type' => 'radio', 'data' => $this->getFieldStatusData("target")],
            'url'         => ['type' => 'text'],
            'icon'        => ['type' => 'text'],
            //            'identity'    => ['type' => 'text'],
            'subhead'     => ['type' => 'text'],
            'alias'       => ['type' => 'text'],
            'description' => ['type' => 'textarea'],
            'star'        => ['type' => 'radio', 'data' => $this->getFieldStatusData("star")],
            'label'       => ['type' => 'text'],
            // 'extend_info' => ['type' => 'text'],
            // 'extend_data' => ['type' => 'text'],
            'sort'        => ['type' => 'text'],
            'status'      => ['type' => 'radio', 'data' => $this->getFieldStatusData("status")],
            'show'        => ['type' => 'radio', 'data' => $this->getFieldStatusData("show")],
        ];
    }

    public function getFieldStatusData(string $field = '')
    {
        if ($field == 'parent_id') {
            $categorys = $this->getArticleCategorySelectArray();
        } else {
            $categorys = [0 => '所有分类'];
        }
        $statusData = array(
            'parent_id' => $categorys,
            'target'    => array(
                '_self'  => '当前窗口',
                '_blank' => '新窗口',
            ),
            'type'      =>
                array(
                    0 => '模块',
                    1 => '菜单',
                    2 => '按钮',
                    3 => '数据',
                    4 => '文件',
                    5 => '维度',
                ),
            'position'  =>
                array(
                    0 => '顶部',
                    1 => '左侧',
                    2 => '右侧',
                    3 => '底部',
                ),
            'star'      =>
                array(
                    1 => '一星',
                    2 => '二星',
                    3 => '三星',
                    4 => '四星',
                    5 => '五星',
                ),
            'show'      =>
                array(
                    0 => '不展示',
                    1 => '展示',
                ),
            'status'    =>
                array(
                    0 => '禁用',
                    1 => '启用',
                ),
        );
        if (isset($statusData[$field])) {
            return $statusData[$field];
        }
        throw new \Exception('不存在该字段的状态配置!');
    }

    public function getFieldStatus(string $field = '', $status = '')
    {
        if ($status === '') {
            throw new \Exception('状态值不能为空!');
        }
        $statusData = $this->getFieldStatusData($field);
        if (isset($statusData[$status])) {
            return $statusData[$status];
        }
        throw new \Exception('不存在该字段的状态配置!');
    }

    public function getArticleCategoryTree()
    {
        $orderBy   = 'sort DESC';
        $categorys = $this->getActiveQuery(['status' => 1])->orderBy($orderBy)->all();
        foreach ($categorys as &$category) {
            $category = $category->toArray();
        }
        $categorys = $this->makeTree($categorys);
        $test      = 'unset';
        $this->makeTree($test); //重置静态变量
//        $array = [0 => '顶级栏目'];
        foreach ($categorys as $key => &$val) {
            $val['grade_name'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $val['grade']) . "|-" . $val['name'];
        }
        unset($category);
        return $categorys;
    }

    public function getArticleCategorySelectArray()
    {
        $categorys = parent::find(['status' => 1])->orderBy('sort DESC')->all();
        foreach ($categorys as &$category) {
            $category = $category->toArray();
        }
        $categorys = $this->makeTree($categorys);
        $test      = 'unset';
        $this->makeTree($test); //重置静态变量
        $array = [0 => '顶级栏目'];
        foreach ($categorys as $key => $val) {
            $array[$val['id']] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $val['grade']) . "|-" . $val['name'];
        }
        unset($category, $categorys);
        return $array;
    }

    /**
     * Created by lonisy@163.com
     * Date: 2018-02-01 12:02:05
     * Description: 生成数列 分类数列
     * @param        $list
     * @param int    $pidval
     * @param int    $gradeval
     * @param string $pidname
     * @param string $id_name
     * @param string $grade_name
     * @return array
     */
    public function makeTree(&$list, $pidval = 0, $gradeval = 1, $pidname = 'parent_id', $id_name = 'id', $grade_name = 'grade')
    {
        static $tree = [];
        if (is_array($list) && count($list)) {
            foreach ($list as $key => $value) {
                if ($value[$pidname] == $pidval) {
                    $value[$grade_name] = $gradeval;
                    $tree[]             = $value;
                    $this->makeTree($list, $value[$id_name], $gradeval + 1, $pidname, $id_name, $grade_name);
                }
            }
        } else if ($list == 'unset') {
            $tree = [];
        }
        return $tree;
    }

    /**
     * @return string
     */
    public function modifyField($field)
    {
//        if (strrpos($field, 'statusTo') === 0) {
//            $statusInfo = explode('statusTo', $field);
//            if (isset($statusInfo[1])) {
//                $this->status = $statusInfo[1] + 0;
//            }
//        }
    }

    public function loadDefautlValues()
    {

    }

    public function beforeUpdate()
    {


    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->identity = md5(uniqid() . rand(1, 100) . rand(1, 100) . rand(1, 100));
            }
            $this->name = trim($this->name);
            return true;
        }
        return false;
    }

    public function beforeCreate()
    {

    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->getCache()->delete('left_sidebar');
        Yii::$app->getCache()->delete('left_sidebar_data');
    }
}
