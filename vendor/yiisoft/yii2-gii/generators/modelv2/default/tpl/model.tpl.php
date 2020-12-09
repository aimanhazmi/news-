<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use __USE_PARENT_CLASS__;

/**
 * This is the model class for table "__TABLE_NAME__".
__PROPERTY_LIST__
 */
class __CLASS_NAME__
{
    const PRIMARY_KEY = '__PRIMARY_KEY__';

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
        return Yii::$app->get('__DB__');
    }

    public static function tableName()
    {
        return '__TABLE_NAME__';
    }

    public function rules()
    {
        return __RULES__;
    }

    public function attributeLabels()
    {
        return __ATTRIBUTE_LABELS__;
    }

    public function getManageTableHead()
    {
        return __MANAGE_TABLE_HEAD__;
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
        return [];
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
        return __FORM_FIELDS__;
    }

    public function getFieldStatusData(string $field = '')
    {
        $statusData = __FIELD_STATUS_DATA__;
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
