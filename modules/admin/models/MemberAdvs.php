<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "member_advs".
 * @property integer id
 * @property integer adv_id
 * @property integer member_id
 * @property string adv_area
 * @property integer adv_banner
 * @property string adv_age
 * @property string adv_height
 * @property string adv_gj
 * @property string adv_xj
 * @property string adv_gf
 * @property integer adv_grade
 * @property string adv_price
 * @property string adv_title
 * @property integer created_at
 * @property integer updated_at
 */
class MemberAdvs extends \yii\db\ActiveRecord
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
        return 'member_advs';
    }

    public function rules()
    {
        return [
            [['adv_id', 'created_at', 'updated_at'], 'integer'],
            [['adv_price'], 'number'],
             [['adv_url'], 'required'],
             [['adv_url'], 'url'],
            [['adv_banner','adv_title'], 'string'],
            [['adv_banner'], 'required'],
            [['adv_grade'],'string', 'max' => 1],
            [['member_id'],'match','pattern'=>'/^[1-9]d*/','message'=>'请选择负责人信息'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'           => '自增ID',
            'adv_id'     => '新闻Id',
            'member_id'    => '负责人',  
            'adv_grade'  => '等级', //  1=>一级; 2=>二级; 3=>三级,
            'adv_price'  => '价格',
            'adv_title'   => '广告标题',
            'adv_url'   => '链接',
            'created_at'   => '录入时间戳',
            'updated_at'   => '更新时间戳',
            'adv_banner'  => '图片',
        ];
    }

    public function getManageTableHead()
    {
        return [
            'id'           => ['comment' => '广告ID'],
            'adv_id'     => ['comment' => '新闻ID'],
            //'adv_name'   => ['comment' => '名称'],
            //'member_id'    => ['comment' => '管理员Id'],
            'member_name'  => ['comment' => '负责人'],
            'adv_banner'  =>  ['comment' => '大图', 'option' => 'img'],
            'adv_grade'  => ['comment' => '等级'],
            'adv_price'  => ['comment' => '价格'],
            //'adv_title'   => ['comment' => '广告标题'],
            'adv_url'   =>  ['comment' => '链接'],
            //'created_at'   => ['comment' => '录入时间'],
            'updated_at'   => ['comment' => '更新时间'],
        ];
    }


    public function getSearchfilterRules($removed = [])
    {
        $rules[] = [
            'type'       => 'search-select',
            'field'      => 'member_id',
            'name'       => '所属分类',
            'default'    => '',
            'listData'   => $this->getFieldStatusData('member_id'),
            'attributes' => [
                'data-size' => 6
            ]
        ];

        if (in_array('adv_id', $removed) == false) {
            $rules[] = [
                'type'    => 'select',
                'field'   => 'adv_id',
                'name'    => '广告名',
                'default' => '',
            ];
        }
        return $rules ?? [];
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
            'adv_id'     => ['type' => 'hidden', 'readonly' => true],
            'member_id'    => [
                'comment' => 'member_id',
                'type'    => 'liveSearch',
                'data'    => $this->getFieldStatusData('member_id')
            ],
              'adv_banner' => ['type' => 'file-image'],
              'adv_grade'  => ['type' => 'radio', 'data' => $this->getFieldStatusData("adv_grade")],
              'adv_price'  => ['type' => 'text'],
              'adv_title'   => ['type' => 'text'],
              'adv_url'    => ['type' => 'text'],
        ];
    }

    public function getFieldStatusData(string $field = '')
    {
        $statusData = [
            'adv_grade' => [
                1 => '一级',
                2 => '二级',
                3 => '三级',
            ],
        ];
        switch ($field) {
            case 'member_id':
                $types = Yii::$app->params[__FUNCTION__ . $field] ?? [];
                if (empty($types)) {
                    $types = [0 => '请选择'];
                    $items = Members::find()->all();
                    if (count($items)) {
                        foreach ($items as $item) {
                            $types[$item->id] = $item->name;
                        }
                    }
                    !empty($types) && Yii::$app->params[__FUNCTION__ . $field] = $types;
                }
                $statusData['member_id'] = $types;
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

    }

    public function beforeUpdate()
    {

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

    public function beforeCreate()
    {

    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }
}
