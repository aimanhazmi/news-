<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "category".
 *  * @property integer id
 * @property integer parent_id
 * @property string title
 * @property string cate_name
 * @property string cate_content
 * @property string img_big
 * @property string img_thumb
 * @property string img_banner
 * @property string keywords
 * @property string description
 * @property integer status
 * @property integer sort
 * @property integer created_at
 * @property integer updated_at
 */
class Category extends \yii\db\ActiveRecord
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
        return 'category';
    }

    public function rules()
    {
        return [
            [['parent_id', 'status', 'sort', 'created_at', 'updated_at'], 'integer'],
            [
                ['title', 'cate_name', 'cate_content', 'img_big', 'img_thumb', 'img_banner', 'keywords', 'description'],
                'string',
                'max' => 255
            ],
        ];

        return [
            [['identity'], 'unique'],
            [
                ['anchor_user_id', 'name', 'idcard', 'front', 'rear', 'profile'],
                'required',
                'message' => '{attribute}为必选项.'
            ],
            [
                ['cate_id', 'version', 'business_modules', 'http_method', 'action_function'],
                'unique',
                'targetAttribute' => ['cate_id', 'version', 'business_modules', 'http_method', 'action_function'],
                'message'         => '该接口已存在,或者有相关业务同名方法!'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'           => '自增Id',
            'parent_id'    => '父级分类', // 父类ID,
            'title'        => '分类标题',
            'cate_name'    => '分类名称',
            'cate_content' => '分类内容',
            'img_big'      => '大图',
            'img_thumb'    => '缩略图',
            'img_banner'   => 'banner图片',
            'keywords'     => '网页关键字',
            'description'  => '网页描述',
            'status'       => '状态', //  0=>隐藏; 1=>显示,
            'sort'         => '分类排序', //  默认升序,值越大越后,
            'created_at'   => '写入时间',
            'updated_at'   => '更新时间',
        ];
    }

    public function getManageTableHead()
    {
        return [
            'id'        => ['comment' => '自增Id'],
            'parent_id' => ['comment' => '上级分类'],
            'title'     => ['comment' => '分类标题'],
            'cate_name' => ['comment' => '分类名称'],
            // 'cate_content' => ['comment' => '分类内容'],
            // 'img_big'      => ['comment' => '大图'],
            // 'img_thumb'    => ['comment' => '缩略图'],
            // 'img_banner'   => ['comment' => 'banner图片'],
            // 'keywords'     => ['comment' => '网页关键字'],
            // 'description'  => ['comment' => '网页描述'],
            // 'status'       => ['comment' => '状态'],
            // 'sort'         => ['comment' => '分类排序'],
            // 'created_at'   => ['comment' => '写入时间'],
            // 'updated_at'   => ['comment' => '更新时间'],
        ];
    }

    /**
     * Created by 李垒(李雷) <leili@yoozoo.com>.
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
                'type'       => 'search-select',
                'field'      => 'parent_id',
                'name'       => '所属分类',
                'default'    => '',
                'listData'   => $this->getFieldStatusData('parent_id'),
                'attributes' => [
                    'data-size' => 4
                ]
            ],
        ];
        //        return [
        //            [
        //                'type'    => 'field',
        //                'field'   => 'field_name',
        //                'name'    => 'name',
        //                'default' => '',
        //            ],
        //            [
        //                'type'     => 'select',
        //                'field'    => 'status',
        //                'name'     => '排序 普通单选下拉',
        //                'default'  => 100,
        //                'listData' => ['0' => '封禁', '1' => '正常'],
        //            ],
        //            [
        //                'type'     => 'select',
        //                'field'    => 'field_name',
        //                'name'     => 'name',
        //                'default'  => '',
        //                'listData' => $this->getFieldStatusData('field_name'),
        //            ],
        //            [
        //                'type'       => 'searchSelect',
        //                'field'      => 'field_name',
        //                'name'       => '所属',
        //                'default'    => '',
        //                'listData'   => $this->getFieldStatusData('field_name'),
        //                'attributes' => [
        //                    'data-size' => 4
        //                ]
        //            ],
        //            [
        //                'type'    => 'date-range',
        //                'field'   => 'created_at',
        //                'name'    => '操作时间',
        //                'default' => [
        //                    'start_date' => '',
        //                    'end_date'   => '',
        //                ],
        //            ],
        //        ];
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
            'parent_id'    => [
                'type'      => 'liveSearch',
                'data-size' => 8,
                'data'      => $this->getFieldStatusData("parent_id")
            ],
            'title'        => ['type' => 'text'],
            'cate_name'    => ['type' => 'text'],
            'cate_content' => ['type' => 'text'],
            'img_big'      => ['type' => 'file-image'],
            'img_thumb'    => ['type' => 'file-image'],
            'img_banner'   => ['type' => 'file-image'],
            'keywords'     => ['type' => 'textarea', 'rows' => 2],
            'description'  => ['type' => 'textarea', 'rows' => 3],
            'sort'         => ['type' => 'text'], //  默认升序,值越大越后,
            'status'       => ['type' => 'radio', 'data' => $this->getFieldStatusData("status")],
        ];
        //        return [
        //            'field_name' => ['type' => 'liveSearch', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => [
        //                'comment' => '字段名',
        //                'type'    => 'liveSearch',
        //                'data'    => $this->getFieldStatusData('field_name')
        //            ],
        //            'field_name' => ['type' => 'textarea', 'id' => 'umeditor', 'rows' => 20],
        //            'field_name' => ['type' => 'radio', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => ['type' => 'file-image'],
        //            'field_name' => ['type' => 'field-datetime'],
        //            'field_name' => ['type' => 'hidden', 'readonly' => true, 'available' => ['update']],
        //            'field_name' => ['type' => 'text', 'maxlength' => 11, 'available' => ['update']],
        //            'field_name' => [
        //                'type'         => 'video',
        //                'help'         => '请上传 10MB 以下格式为 mp4 或者 flv 类型视频文件！',
        //                'maxChunkSize' => 1000000
        //            ],
        //            'field_name' => ['type' => 'hidden'],
        //            'field_name' => ['type' => 'text', 'available' => ['create']],
        //            'field_name' => ['type' => 'hidden', 'available' => ['update']],
        //            'field_name' => ['type' => 'json'],
        //            'field_name' => ['type' => 'json', 'rows' => 12],
        //            'field_name' => [
        //                'type'   => 'liveSearch',
        //                'prompt' => '请选择',
        //                'data'   => $this->getFieldStatusData("field_name")
        //            ],
        //            'field_name' => [
        //                'type'   => 'liveSearch',
        //                'prompt' => '请选择',
        //                'data'   => $this->getFieldStatusData("field_name")
        //            ],
        //            'field_name' => ['type' => 'multipleSelect', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => ['type' => 'radio', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => ['type' => 'select', 'prompt' => '请选择', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => ['type' => 'radio', 'data' => $this->getFieldStatusData("field_name")],
        //            'field_name' => ['type' => 'text', 'maxlength' => '16'],
        //        ];
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
            $array[$val['id']] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $val['grade']) . "|-" . $val['cate_name'];
        }
        unset($category, $categorys);
        return $array;
    }

    /**
     * Created by lonisy@163.com
     * Date: 2018-02-01 12:02:05
     * Description: 生成数列 分类数列
     * @param        $list
     * @param int $pidval
     * @param int $gradeval
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

    public function getFieldStatusData(string $field = '')
    {
        if ($field == 'parent_id') {
            $categorys = $this->getArticleCategorySelectArray();
        } else {
            $categorys = [0 => '所有分类'];
        }
        $statusData = [
            'parent_id' => $categorys,
            'status'    => [
                0 => '隐藏',
                1 => '显示',
            ],
        ];

        //        switch ($field) {
        //            #case '?field_name?':
        //                $types = Yii::$app->params[__FUNCTION__ . $field] ?? [];
        //                if (empty($types)) {
        //                    #$models = ?Model?::find()->all();;
        //                    if (count($models)) {
        //                        foreach ($models as $model) {
        //                            # $types[$model->?ID?] = $model->?NAME?;
        //                        }
        //                    }
        //                    !empty($types) && Yii::$app->params[__FUNCTION__ . $field] = $types;
        //                }
        //                #$statusData['?field_name?'] = $types;
        //                break;
        //        }

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

    public function loadDefautlValues()
    {
        //        $this->start_time = date('Y-m-d H:i:s');
        //        $this->end_time   = date('Y-m-d H:i:s');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                // TODO ...
            }
            return true;
        }
        return false;
    }

    public function beforeUpdate()
    {
        $this->beforeFetch();
        $redis         = Yii::$app->redis;  
        $delkeys=$redis->del('index:categorys');
        
    }

    public function beforeCreate()
    {
        $this->beforeFetch();
    }

    /**
     * Created by 李垒(李雷) <leili@yoozoo.com>.
     * Date: 2018-03-01 17:32:18
     * Description: 用于读数据时自动转化数据
     */
    public function afterFetch()
    {
        //        if (!empty($this->business_related)) {
        //            $this->business_related = json_decode($this->business_related, false);
        //        }
        //        if (!empty($this->business_related_developer)) {
        //            $this->business_related_developer = json_decode($this->business_related_developer, false);
        //        }
    }

    /**
     * Created by 李垒(李雷) <leili@yoozoo.com>.
     * Date: 2018-03-01 17:34:31
     * Description: 用于写数据时自动转化数据
     * @param $model
     */
    public function beforeFetch()
    {
        //        if (is_string($this->start_time)) {
        //            $this->start_time = strtotime($this->start_time) ? strtotime($this->start_time) : 0;
        //        }
        //        if (is_string($this->end_time)) {
        //            $this->end_time = strtotime($this->end_time) ? strtotime($this->end_time) : 0;
        //        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert){

            $redis         = Yii::$app->redis;  
            $delkeys=$redis->del('index:categorys');
        }    
    }
}
