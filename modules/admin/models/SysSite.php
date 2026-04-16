<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "sys_site".
 * @property integer id
 * @property string site_name
 * @property string title
 * @property string keywords
 * @property string description
 * @property string logo
 * @property string qrcode
 * @property string email
 * @property string qq
 * @property string phone
 * @property string address
 * @property string ad0
 * @property string ad1
 * @property string ad2
 * @property string ad3
 * @property string ad4
 * @property string ad5
 * @property string ad6
 * @property string ad7
 * @property string ad8
 * @property string ad9
 * @property string banner1
 * @property string banner2
 * @property string banner3
 * @property string banner4
 * @property string banner1_target
 * @property string banner2_target
 * @property string banner3_target
 * @property string banner4_target
 * @property string header_code
 * @property string statistical_code
 * @property string safe_warning
 * @property integer open_reg
 * @property integer service_status
 * @property integer created_at
 * @property integer updated_at
 */
class SysSite extends \yii\db\ActiveRecord
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
        return 'sys_site';
    }

    public function rules()
    {
        return [
            [['open_reg', 'service_status', 'created_at', 'updated_at'], 'integer'],
            [
                [
                    'site_name',
                    'title',
                    'keywords',
                    'description',
                    'logo',
                    'qrcode',
                    'email',
                    'qq',
                    'phone',
                    'address',
                    'ad0',
                    'ad1',
                    'ad2',
                    'ad3',
                    'ad4',
                    'ad5',
                    'ad6',
                    'ad7',
                    'ad8',
                    'ad9',
                    'banner1',
                    'banner2',
                    'banner3',
                    'banner4',
                    'banner1_target',
                    'banner2_target',
                    'banner3_target',
                    'banner4_target',
                    'safe_warning'
                ],
                'string',
                'max' => 255
            ],
            [['header_code', 'statistical_code'], 'string', 'max' => 2000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'               => '主键ID',
            'site_name'        => '网站名',
            'title'            => '网页标题',
            'keywords'         => '网页关键字',
            'description'      => '网页描述',
            'logo'             => '站点logo',
            'qrcode'           => '公众号二维码',
            'email'            => '联系邮箱',
            'qq'               => '客服 QQ',
            'phone'            => '客服手机号',
            'address'          => '联系地址',
            'ad0'              => '广告1',
            'ad1'              => '广告2',
            'ad2'              => '广告3',
            'ad3'              => '广告4',
            'ad4'              => '广告5',
            'ad5'              => '广告6',
            'ad6'              => '广告7',
            'ad7'              => '广告8',
            'ad8'              => '广告9',
            'ad9'              => '广告10',
            'banner1'          => 'banner广告1',
            'banner2'          => 'banner广告2',
            'banner3'          => 'banner广告3',
            'banner4'          => 'banner广告4',
            'banner1_target'   => 'banner广告1链接',
            'banner2_target'   => 'banner广告2链接',
            'banner3_target'   => 'banner广告3链接',
            'banner4_target'   => 'banner广告4链接',
            'header_code'      => 'head 插入代码,统计,客服类',
            'statistical_code' => 'body 插入代码,统计,客服类',
            'safe_warning'     => '安全提示',
            'open_reg'         => '状态', //  0=>关闭注册; 1=>开放注册,
            'service_status'   => '状态', //  0=>停站维护; 1=>运行中,
            'created_at'       => '创建时间戳',
            'updated_at'       => '更新时间戳',
        ];
    }

    public function getManageTableHead()
    {
        return [
            'id'        => ['comment' => '主键ID'],
            'site_name' => ['comment' => '网站名'],
            'title'     => ['comment' => '网页标题'],
            'keywords'  => ['comment' => '网页关键字'],
            // 'description'      => ['comment' => '网页描述'],
            // 'logo'             => ['comment' => '站点logo'],
            // 'qrcode'           => ['comment' => '公众号二维码'],
            // 'email'            => ['comment' => '联系邮箱'],
            // 'qq'               => ['comment' => '客服 QQ'],
            // 'phone'            => ['comment' => '客服手机号'],
            // 'address'          => ['comment' => '联系地址'],
            // 'ad0'              => ['comment' => '广告'],
            // 'ad1'              => ['comment' => '广告'],
            // 'ad2'              => ['comment' => '广告'],
            // 'ad3'              => ['comment' => '广告'],
            // 'ad4'              => ['comment' => '广告'],
            // 'ad5'              => ['comment' => '广告'],
            // 'ad6'              => ['comment' => '广告'],
            // 'ad7'              => ['comment' => '广告'],
            // 'ad8'              => ['comment' => '广告'],
            // 'ad9'              => ['comment' => '广告'],
            // 'banner1'          => ['comment' => 'banner广告1'],
            // 'banner2'          => ['comment' => 'banner广告2'],
            // 'banner3'          => ['comment' => 'banner广告3'],
            // 'banner4'          => ['comment' => 'banner广告4'],
            // 'banner1_target'   => ['comment' => 'banner广告4'],
            // 'banner2_target'   => ['comment' => 'banner广告4'],
            // 'banner3_target'   => ['comment' => 'banner广告4'],
            // 'banner4_target'   => ['comment' => 'banner广告4'],
            // 'header_code'      => ['comment' => 'head 插入代码,统计,客服类'],
            // 'statistical_code' => ['comment' => 'body 插入代码,统计,客服类'],
            // 'safe_warning'     => ['comment' => '安全提示'],
            // 'open_reg'         => ['comment' => '状态'],
            // 'service_status'   => ['comment' => '状态'],
            // 'created_at'       => ['comment' => '创建时间戳'],
            // 'updated_at'       => ['comment' => '更新时间戳'],
        ];
    }

    /**
     * Created by aiman
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
        return [
            'site_name'        => ['type' => 'text'],
            'title'            => ['type' => 'text'],
            'keywords'         => ['type' => 'textarea', 'rows' => 2],
            'description'      => ['type' => 'textarea', 'rows' => 3],
            'logo'             => ['type' => 'file-image'],
            'qrcode'           => ['type' => 'text'],
            'email'            => ['type' => 'text'],
            'qq'               => ['type' => 'text'],
            'phone'            => ['type' => 'text'],
            'address'          => ['type' => 'text'],
            'ad0'              => ['type' => 'file-image'],
            'ad1'              => ['type' => 'file-image'],
            'ad2'              => ['type' => 'file-image'],
            'ad3'              => ['type' => 'file-image'],
//            'ad4'              => ['type' => 'file-image'],
//            'ad5'              => ['type' => 'file-image'],
//            'ad6'              => ['type' => 'file-image'],
//            'ad7'              => ['type' => 'file-image'],
//            'ad8'              => ['type' => 'file-image'],
//            'ad9'              => ['type' => 'file-image'],
            'banner1'          => ['type' => 'file-image'],
            'banner2'          => ['type' => 'file-image'],
            'banner3'          => ['type' => 'file-image'],
            'banner4'          => ['type' => 'file-image'],
            'banner1_target'   => ['type' => 'text'],
            'banner2_target'   => ['type' => 'text'],
            'banner3_target'   => ['type' => 'text'],
            'banner4_target'   => ['type' => 'text'],
            'header_code'      => ['type' => 'textarea', 'id' => 'umeditor', 'rows' => 4],
            'statistical_code' => ['type' => 'textarea', 'rows' => 4],
            'safe_warning'     => ['type' => 'text'],
            'open_reg'         => ['type' => 'radio', 'data' => $this->getFieldStatusData("open_reg")],
            'service_status'   => ['type' => 'radio', 'data' => $this->getFieldStatusData("service_status")],
        ];
    }

    public function getFieldStatusData(string $field = '')
    {
        $statusData = [
            'open_reg'       => [
                0 => '关闭注册',
                1 => '开放注册',
            ],
            'service_status' => [
                0 => '停站维护',
                1 => '运行中',
            ],
        ];
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
        $redis         = Yii::$app->redis;  
        $delkeys=$redis->del('index:siteinfo');
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
        if($insert){

            $redis         = Yii::$app->redis;  
            $delkeys=$redis->del('index:siteinfo');
        }  
    }
}
