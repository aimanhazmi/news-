<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "article".
 *  * @property string id
 * @property integer category_id
 * @property string art_title
 * @property string art_content
 * @property string art_author
 * @property string img_big
 * @property string img_thumb
 * @property string img_banner
 * @property string keywords
 * @property string description
 * @property integer status
 * @property integer sort
 * @property integer pv
 * @property integer reltime
 * @property string tags
 * @property integer isnew
 * @property integer istop
 * @property integer created_at
 * @property integer updated_at
 */
class Article extends \yii\db\ActiveRecord
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
        return 'article';
    }

    public function rules()
    {
        return [
            [
                ['category_id', 'status', 'sort', 'pv', 'reltime', 'isnew', 'istop', 'created_at', 'updated_at'],
                'integer'
            ],
            [['art_content'], 'required'],
            [['art_content'], 'string'],
            [
                ['art_title','art_source', 'art_author', 'img_big', 'img_thumb', 'img_banner', 'keywords', 'description', 'tags'],
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
            'id'          => '主键ID',
            'category_id' => '所属分类',
            'art_title'   => '文章标题',
            'art_content' => '文章正文',
            'art_author'  => '文章作者',
            'art_source'  => '文章来源',
            'img_big'     => '大图',
            'img_thumb'   => '缩略图/封面',
            'img_banner'  => 'banner图',
            'keywords'    => '网页关键字',
            'description' => '网页描述',
            'status'      => '状态', //  0=>隐藏; 1=>显示,
            'sort'        => '文章排序',
            'pv'          => '浏览量',
            'reltime'     => '文章发布时间',
            'tags'        => '文章标签',
            'isnew'       => '标新', //  0=>否; 1=>是,
            'istop'       => '置顶', //  0=>不置顶; 1=>置顶,
            'created_at'  => '创建时间',
            'updated_at'  => '更新时间',
        ];
    }

    public function getManageTableHead()
    {
        return [
            'id'          => ['comment' => '主键ID'],
            'category_name' => ['comment' => '所属分类'],
//            'category_id' => ['comment' => '所属分类'],
            'art_title'   => ['comment' => '文章标题'],
            //            'art_content' => ['comment' => '文章正文'],
            'art_author'  => ['comment' => '文章作者'],
            'img_big'     => ['comment' => '大图', 'option' => 'img'],
            //            'img_thumb'   => ['comment' => '缩略图/封面', 'option' => 'img'],
            //            'img_banner'  => ['comment' => 'banner图', 'option' => 'img'],
            // 'keywords'    => ['comment' => '网页关键字'],
            // 'description' => ['comment' => '网页描述'],
            //            'status'      => ['comment' => '状态'],
            //            'sort'        => ['comment' => '文章排序'],
            // 'pv'          => ['comment' => '浏览量'],
            // 'reltime'     => ['comment' => '文章发布时间'],
            // 'tags'        => ['comment' => '文章标签'],
            // 'isnew'       => ['comment' => '标新'],
            // 'istop'       => ['comment' => '置顶'],
            'created_at'  => ['comment' => '创建时间'],
            // 'updated_at'  => ['comment' => '更新时间'],
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
    public function getSearchfilterRules($removed = [])
    {
        $rules[] = [
            'type'       => 'search-select',
            'field'      => 'category_id',
            'name'       => '所属分类',
            'default'    => '',
            'listData'   => $this->getFieldStatusData('category_id'),
            'attributes' => [
                'data-size' => 4
            ]
        ];
        if (in_array('category_ids', $removed) == false) {
            $rules[] = [
                'type'       => 'multiple-select',
                'field'      => 'category_ids',
                'name'       => '所属分类(多选)',
                'default'    => '',
                'listData'   => $this->getFieldStatusData('category_id'),
                'attributes' => [
                    'data-size' => 4
                ]
            ];
        }
        return $rules;


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
                                if ($field == 'category_ids') {
                                    $field = 'category_id';
                                }
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
            'category_id' => [
                'comment' => '所属分类',
                'type'    => 'liveSearch',
                'data'    => $this->getFieldStatusData('category_id')
            ],
            'art_title'   => ['type' => 'text'],
            'art_content' => ['type' => 'textarea', 'id' => 'umeditor', 'rows' => 20],
            'art_author'  => ['type' => 'text'],
            'art_source'  => ['type' => 'text'],
            'img_big'     => ['type' => 'file-image'],
            'img_thumb'   => ['type' => 'file-image'],
            'img_banner'  => ['type' => 'file-image'],
            'keywords'    => ['type' => 'textarea', 'rows' => 2],
            'description' => ['type' => 'textarea', 'rows' => 3],
            'sort'        => ['type' => 'text'],
            'pv'          => ['type' => 'text'],
            'reltime'     => ['type' => 'field-datetime'],
            'tags'        => ['type' => 'text', 'help' => '请输入标签词，用空格隔开。'],
            'isnew'       => ['type' => 'radio', 'data' => $this->getFieldStatusData("isnew")],
            'istop'       => ['type' => 'radio', 'data' => $this->getFieldStatusData("istop")],
            'status'      => ['type' => 'radio', 'data' => $this->getFieldStatusData("status")],
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

    public function getFieldStatusData(string $field = '')
    {
        $statusData = [
            'status' => [
                0 => '隐藏',
                1 => '显示',
            ],
            'isnew'  => [
                0 => '否',
                1 => '是',
            ],
            'istop'  => [
                0 => '不置顶',
                1 => '置顶',
            ],
        ];

        switch ($field) {
            case 'category_id':
                $types = Yii::$app->params[__FUNCTION__ . $field] ?? [];
                if (empty($types)) {
                    //                    $models = Category::find()->all();;
                    //                    if (count($models)) {
                    //                        foreach ($models as $model) {
                    //                            $types[$model->id] = $model->cate_name;
                    //                        }
                    //                    }
                    $Category = new Category();
                    $types    = $Category->getArticleCategorySelectArray();
                    !empty($types) && Yii::$app->params[__FUNCTION__ . $field] = $types;
                }
                $statusData['category_id'] = $types;
                break;
        }

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
        $this->reltime = date('Y-m-d H:i:s');
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
        $delkeys=$redis->del('index:items');

     //   $postfix=0;
     //   do {
     //      $delkeys=$redis->del('index:items'.$postfix);
     //      $postfix=$postfix+1;
     //  } while ($delkeys);
        
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
        if (is_string($this->reltime)) {
            $this->reltime = strtotime($this->reltime) ? strtotime($this->reltime) : 0;
        }
        //        if (is_string($this->end_time)) {
        //            $this->end_time = strtotime($this->end_time) ? strtotime($this->end_time) : 0;
        //        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){

            $redis         = Yii::$app->redis;  
            $delkeys=$redis->del('index:items');

           //$postfix=0;
           // do {
           //   $delkeys=$redis->del('index:items'.$postfix);
           //   $postfix=$postfix+1;
           // } while ($delkeys);
        }   
      
    }
}
