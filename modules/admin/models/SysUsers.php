<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "itv_users".
 * @property string id
 * @property string login_name
 * @property string login_pwd
 * @property string access_token
 * @property integer expiry
 * @property string nickname
 * @property string mobile
 * @property string role
 * @property string avatar
 * @property string mail
 * @property string qq
 * @property integer sex
 * @property integer amount
 * @property integer point
 * @property string ua
 * @property string ip
 * @property integer vip
 * @property string last_access_ip
 * @property integer last_access_time
 * @property string city
 * @property string referer
 * @property string channel
 * @property integer visits
 * @property integer online_time
 * @property string from_user_id
 * @property string extend_info
 * @property string visitor_identity
 * @property string operating_system
 * @property string browser
 * @property string browser_version
 * @property string device_name
 * @property integer leave_time
 * @property integer is_robot
 * @property integer is_desktop
 * @property integer is_phone
 * @property integer status
 * @property integer created_at
 * @property integer updated_at
 */
class SysUsers extends \yii\db\ActiveRecord
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
        return 'sys_users';
    }


    public function rules()
    {
        return [
            [
                [
                    'expiry',
                    'sex',
                    'amount',
                    'watch_time',
                    'allow_watch_time',
                    'point',
                    'last_access_time',
                    'visits',
                    'vip',
                    'online_time',
                    'from_user_id',
                    'leave_time',
                    'is_robot',
                    'is_desktop',
                    'is_phone',
                    'status',
                    'created_at',
                    'updated_at'
                ],
                'integer'
            ],
            [
                [
                    'avatar',
                    'ua',
                    'ip',
                    'last_access_ip',
                    'city',
                    'referer',
                    'channel',
                    'visitor_identity',
                    'operating_system',
                    'browser',
                    'browser_version',
                    'device_name'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'login_name',
                    'nickname',
                    'mobile',
                    'role',
                    'mail',
                    'qq'
                ],
                'string',
                'max' => 64
            ],
            [
                ['login_pwd'],
                'string',
                'max' => 256
            ],
            [
                ['mobile'],
                'unique',
                'message' => '该{attribute}已存在！'
            ],
            [
                ['mobile'],
                'required',
                'on' => ['reg']
            ],
            // [['mobile'], 'required', 'on' => ['visitor'], 'message' => '请输入{attribute}！'],
            [
                [
                    'nickname',
                    'qq'
                ],
                'required',
                'on'      => ['assistant'],
                'message' => '请输入{attribute}！'
            ],
            [
                ['mail'],
                'email',
                'message' => '请输入正确的{attribute}'
            ],
            //            [['mobile'], 'match', 'pattern' => '/^1[34578]\d{9}$/', 'message' => '请输入正确的手机号'],
            [
                ['access_token'],
                'string',
                'max' => 128
            ],
            [
                ['extend_info'],
                'string',
                'max' => 2000
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'               => '主键ID',
            'login_name'       => '登录名',
            'login_pwd'        => '密码',
            'access_token'     => '令牌',
            'expiry'           => '令牌有效期时间戳',
            'nickname'         => '昵称',
            'mobile'           => '手机号',
            'role'             => '角色',
            //  admin; teacher; anchor; assistant; robot; client;,
            'avatar'           => '头像',
            'mail'             => 'mail',
            'qq'               => 'QQ号',
            'sex'              => '性别',
            //  0=>女; 1=>男; 2=>保密,
            'amount'           => '余额',
            'point'            => '积分',
            'ua'               => '浏览器 User-Agent',
            'ip'               => '来源 IP',
            'vip'              => '等级',
            'last_access_ip'   => '末次访问 IP',
            'last_access_time' => '末次访问时间戳',
            'city'             => '所在地',
            'referer'          => '来源网址',
            'channel'          => '推广渠道',
            'visits'           => '访问次数',
            'online_time'      => '在线时长',
            'from_user_id'     => '客户经理 ID',
            'extend_info'      => '扩展参数',
            'visitor_identity' => '客户端身份标示',
            'operating_system' => '操作系统',
            'browser'          => '浏览器',
            'browser_version'  => '浏览器版本',
            'device_name'      => '设备名称',
            'leave_time'       => '离开时间',
            'is_robot'         => '机器人',
            //  0=>否; 1=>是,
            'is_desktop'       => '桌面设备',
            //  0=>否; 1=>是,
            'is_phone'         => '手机用户',
            //  0=>否; 1=>是,
            'watch_time'       => '已观看时间',
            //  0=>否; 1=>是,
            'allow_watch_time' => '允许观看时间',
            //  0=>否; 1=>是,
            'status'           => '状态',
            //  0=>禁用; 1=>启用,
            'created_at'       => '创建时间戳',
            'updated_at'       => '更新时间戳',
        ];
    }

    public function getSearchwordsregisterAnalysisTableHead()
    {
        return [
            'referer_keywords' => ['comment' => '关键词'],
            'register_num'     => ['comment' => '注册量'],
            'referer_name'     => ['comment' => '来源'],
            'referer_domain'   => ['comment' => '来源网址'],
            'channel'          => ['comment' => '渠道'],
            'city'             => ['comment' => '区域'],
        ];
    }

    public function getSourceRegisterAnalysisTableHead()
    {
        return [
            'referer_name'   => ['comment' => '来源'],
            'register_num'   => ['comment' => '注册量'],
            'referer_domain' => ['comment' => '来源网址'],
        ];
    }

    public function getSearchwordsAnalysisTableHead()
    {
        return [
            'referer_keywords' => ['comment' => '关键词'],
            'referer_name'     => ['comment' => '来源'],
            'referer_domain'   => ['comment' => '来源网址'],
            'channel'          => ['comment' => '渠道'],
            'ip'               => ['comment' => 'IP'],
            'city'             => ['comment' => '区域地址'],
            'created_at'       => ['comment' => '来访时间'],
            'created_at_1'     => ['comment' => '最后登录时间'],
            'created_at_2'     => ['comment' => '观看时长'],
        ];
    }


    public function getVisitorManageTableHead()
    {
        return [
            'visitor_name' => [
                'comment' => '游客',
                'fixed'   => true
            ],

            'visits'           => ['comment' => '来访次数'],
            //            'login_name'       => ['comment' => '登录名'],//, 'option' => 'img'
            //            'login_pwd'        => ['comment' => '密码'],
            //            'access_token'     => ['comment' => '令牌'],
            // 'expiry'           => ['comment' => '令牌有效期时间戳'],
            //            'nickname'         => ['comment' => '昵称'],
            //            'mobile'           => ['comment' => '手机号'],
            // 'role'             => ['comment' => '角色'],
            // 'avatar'           => ['comment' => '头像'],
            // 'mail'             => ['comment' => 'mail'],
            // 'qq'               => ['comment' => 'qq'],
            // 'sex'              => ['comment' => '性别'],
            // 'amount'           => ['comment' => '余额'],
            // 'point'            => ['comment' => '积分'],
            // 'ua'               => ['comment' => '浏览器 User-Agent'],
            // 'last_access_ip'   => ['comment' => '末次访问 IP'],
            // 'last_access_time' => ['comment' => '末次访问时间戳'],
            'city'             => ['comment' => '所在地'],
            'referer'          => [
                'comment'   => '来源网址',
                'option'    => 'link',
                'dataField' => '_referer'
            ],
            'channel'          => ['comment' => '推广渠道'],
            // 'online_time'  => ['comment' => '在线时长'],
            // 'from_user_id'     => ['comment' => 'FROM_USER_ID'],
            // 'extend_info'      => ['comment' => '扩展参数'],
            // 'visitor_identity' => ['comment' => '客户端身份标示'],
            // 'operating_system' => ['comment' => '操作系统'],
            'browser'          => ['comment' => '浏览器'],
            // 'browser_version'  => ['comment' => '浏览器版本'],
            // 'device_name'      => ['comment' => '设备名称'],
            // 'leave_time'       => ['comment' => '离开时间'],
            // 'is_robot'         => ['comment' => '机器人'],
            // 'is_desktop'       => ['comment' => '桌面设备'],
            // 'is_phone'         => ['comment' => '手机用户'],
            'ip'               => ['comment' => '来源 IP'],
            'created_at'       => ['comment' => '首次来访时间'],
            'last_access_time' => ['comment' => '最后登陆时间'],
            'watch_time'       => ['comment' => '已观看时长'],
            'allow_watch_time' => ['comment' => '可以观看时长'],
            'banned_status'    => ['comment' => '是否已禁言'],
            'black_status'     => ['comment' => '是否黑名单'],
            'status'           => ['comment' => '状态'],

        ];
    }

    public function getRobotManageTableHead()
    {
        return [
            'id'        => ['comment' => 'ID'],
            'vip'       => ['comment' => '等级'],
            'nickname'  => ['comment' => '马甲名称'],
            'from_user' => ['comment' => '所有者'],
        ];
    }

    public function getClientManageTableHead()
    {
        return [
            'id'         => ['comment' => 'ID'],
            'from_user'  => ['comment' => '所属经理'],
            'login_name' => ['comment' => '客户登录名'],
            'nickname'   => ['comment' => '客户昵称'],
            'mobile'     => ['comment' => '手机号'],
            'sex'        => ['comment' => '性别'],
            'ip'         => ['comment' => 'IP'],
            'vip'        => ['comment' => '等级'],
            'city'       => ['comment' => '所在地'],
            'referer'    => ['comment' => '来源'],
            'created_at' => ['comment' => '注册时间'],
            'updated_at' => ['comment' => '最近登录时间'],
            'status'     => ['comment' => '状态'],
            //            'visits'       => ['comment' => '来访次数'],
            //            'login_name'       => ['comment' => '登录名'],
            //            'login_pwd'        => ['comment' => '密码'],
            //            'access_token'     => ['comment' => '令牌'],
            // 'expiry'           => ['comment' => '令牌有效期时间戳'],
            // 'role'             => ['comment' => '角色'],
            // 'avatar'           => ['comment' => '头像'],
            // 'mail'             => ['comment' => 'mail'],
            // 'qq'               => ['comment' => 'qq'],
            // 'amount'           => ['comment' => '余额'],
            // 'point'            => ['comment' => '积分'],
            // 'ua'               => ['comment' => '浏览器 User-Agent'],
            // 'last_access_ip'   => ['comment' => '末次访问 IP'],
            //            'city'         => ['comment' => '所在地'],
            //            'referer'      => ['comment' => '来源网址'],
            //            'channel'      => ['comment' => '推广渠道'],
            // 'online_time'  => ['comment' => '在线时长'],
            // 'from_user_id'     => ['comment' => 'FROM_USER_ID'],
            // 'extend_info'      => ['comment' => '扩展参数'],
            // 'visitor_identity' => ['comment' => '客户端身份标示'],
            // 'operating_system' => ['comment' => '操作系统'],
            //            'browser'      => ['comment' => '浏览器'],
            // 'browser_version'  => ['comment' => '浏览器版本'],
            // 'device_name'      => ['comment' => '设备名称'],
            // 'leave_time'       => ['comment' => '离开时间'],
            // 'is_robot'         => ['comment' => '机器人'],
            // 'is_desktop'       => ['comment' => '桌面设备'],
            // 'is_phone'         => ['comment' => '手机用户'],
            //            'ip'           => ['comment' => '来源 IP'],
            //            'created_at'   => ['comment' => '首次来访时间'],
            //             'updated_at'       => ['comment' => '更新时间戳'],
        ];
    }


    public function getMyClientResultsManageTableHead()
    {
        return [
            'days'          => ['comment' => '日期'],
            'visitor_total' => ['comment' => '游客数'],
            'client_total'  => ['comment' => '会员数'],
        ];
    }

    public function getManageTableHead()
    {
        return [
            'id'           => ['comment' => '主键ID'],
            'login_name'   => ['comment' => '登录名'],
            'login_pwd'    => ['comment' => '密码'],
            'access_token' => ['comment' => '令牌'],
            // 'expiry'           => ['comment' => '令牌有效期时间戳'],
            // 'nickname'         => ['comment' => '昵称'],
            // 'mobile'           => ['comment' => '手机号'],
            // 'role'             => ['comment' => '角色'],
            // 'avatar'           => ['comment' => '头像'],
            // 'mail'             => ['comment' => 'mail'],
            // 'qq'               => ['comment' => 'qq'],
            // 'sex'              => ['comment' => '性别'],
            // 'amount'           => ['comment' => '余额'],
            // 'point'            => ['comment' => '积分'],
            // 'ua'               => ['comment' => '浏览器 User-Agent'],
            // 'ip'               => ['comment' => '来源 IP'],
            // 'last_access_ip'   => ['comment' => '末次访问 IP'],
            // 'last_access_time' => ['comment' => '末次访问时间戳'],
            // 'city'             => ['comment' => '所在地'],
            // 'referer'          => ['comment' => '来源网址'],
            // 'channel'          => ['comment' => '推广渠道'],
            // 'visits'           => ['comment' => '访问次数'],
            // 'online_time'      => ['comment' => '在线时长'],
            // 'from_user_id'     => ['comment' => 'FROM_USER_ID'],
            // 'extend_info'      => ['comment' => '扩展参数'],
            // 'visitor_identity' => ['comment' => '客户端身份标示'],
            // 'operating_system' => ['comment' => '操作系统'],
            // 'browser'          => ['comment' => '浏览器'],
            // 'browser_version'  => ['comment' => '浏览器版本'],
            // 'device_name'      => ['comment' => '设备名称'],
            // 'leave_time'       => ['comment' => '离开时间'],
            // 'is_robot'         => ['comment' => '机器人'],
            // 'is_desktop'       => ['comment' => '桌面设备'],
            // 'is_phone'         => ['comment' => '手机用户'],
            // 'status'           => ['comment' => '状态'],
            // 'created_at'       => ['comment' => '创建时间戳'],
            // 'updated_at'       => ['comment' => '更新时间戳'],
        ];
    }

    public function getAssistantManageTableHead()
    {
        return [
            'id'         => ['comment' => '主键ID'],
            'login_name' => ['comment' => '登录名'],
            // 'expiry'           => ['comment' => '令牌有效期时间戳'],
            'mobile'     => ['comment' => '手机号'],
            'nickname'   => ['comment' => '昵称'],
            // 'role'             => ['comment' => '角色'],
            'avatar'     => [
                'comment' => '头像',
                'option'  => 'img'
            ],
            // 'mail'             => ['comment' => 'mail'],
            'qq'         => ['comment' => 'QQ'],
            'sex'        => ['comment' => '性别'],
            // 'amount'           => ['comment' => '余额'],
            // 'point'            => ['comment' => '积分'],
            // 'ua'               => ['comment' => '浏览器 User-Agent'],
            // 'ip'               => ['comment' => '来源 IP'],
            // 'last_access_ip'   => ['comment' => '末次访问 IP'],
            // 'last_access_time' => ['comment' => '末次访问时间戳'],
            // 'city'             => ['comment' => '所在地'],
            // 'referer'          => ['comment' => '来源网址'],
            // 'channel'          => ['comment' => '推广渠道'],
            // 'visits'           => ['comment' => '访问次数'],
            // 'online_time'      => ['comment' => '在线时长'],
            // 'from_user_id'     => ['comment' => 'FROM_USER_ID'],
            // 'extend_info'      => ['comment' => '扩展参数'],
            // 'visitor_identity' => ['comment' => '客户端身份标示'],
            // 'operating_system' => ['comment' => '操作系统'],
            // 'browser'          => ['comment' => '浏览器'],
            // 'browser_version'  => ['comment' => '浏览器版本'],
            // 'device_name'      => ['comment' => '设备名称'],
            // 'leave_time'       => ['comment' => '离开时间'],
            // 'is_robot'         => ['comment' => '机器人'],
            // 'is_desktop'       => ['comment' => '桌面设备'],
            // 'is_phone'         => ['comment' => '手机用户'],
            'status'     => ['comment' => '状态'],
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
        return [
            [
                'type'     => 'select',
                'field'    => 'status',
                'name'     => '客户状态',
                'default'  => '',
                'listData' => $this->getFieldStatusData("status")
            ],
            [
                'type'     => 'eq',
                'field'    => 'role',
                'name'     => '角色',
                'default'  => '',
                'listData' => $this->getFieldStatusData("role")
            ],

            [
                'type'    => 'eq',
                'field'   => 'from_user_id',
                'name'    => '所属用户',
                'default' => '',
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
                                $query->andOnCondition([
                                    'between',
                                    $field,
                                    $startDate,
                                    $endDate
                                ]);
                            }
                            break;
                        case "field":
                            if ($value !== '') {
                                $query->andOnCondition([
                                    'like',
                                    $field,
                                    $value
                                ]);
                            }
                            break;
                        case "select":
                            if ($value !== '') {
                                $query->andOnCondition([$field => $value]);
                            }
                            break;
                        case "eq":
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
                                $query->andOnCondition([
                                    'in',
                                    $field,
                                    $value
                                ]);
                            }
                            break;
                    }
                }
            }
        }
        return $query;
    }

    public function getRobotFormFields()
    {
        return [
            'nickname' => ['type' => 'text', 'label' => '马甲名', 'help' => '当前用户只能为自己创建马甲！'],
            'vip'      => [
                'type'      => 'text',
                'label'     => '等级',
                'maxlength' => 2,
                'help'      => '最大等级请参考等级配置！'
            ],
        ];
    }

    public function getFormFields()
    {
        return [
            'login_name'       => ['type' => 'text'],
            'login_pwd'        => [
                'type'        => 'password',
                'placeholder' => '请输入密码',
                'help'        => '如修改密码,输入新密码即可!默认: 123456'
            ],
            'access_token'     => ['type' => 'text'],
            'expiry'           => ['type' => 'text'],
            'nickname'         => ['type' => 'text'],
            'mobile'           => ['type' => 'text'],
            'role'             => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("role")
            ],
            //  admin; teacher; anchor; assistant; robot; client;,
            'avatar'           => ['type' => 'text'],
            'mail'             => ['type' => 'text'],
            'qq'               => ['type' => 'text'],
            'sex'              => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("sex")
            ],
            'amount'           => ['type' => 'text'],
            'point'            => ['type' => 'text'],
            'ua'               => ['type' => 'text'],
            'ip'               => ['type' => 'text'],
            'last_access_ip'   => ['type' => 'text'],
            'last_access_time' => ['type' => 'text'],
            'city'             => ['type' => 'text'],
            'referer'          => ['type' => 'text'],
            'channel'          => ['type' => 'text'],
            'visits'           => ['type' => 'text'],
            'online_time'      => ['type' => 'text'],
            'from_user_id'     => ['type' => 'text'],
            'extend_info'      => ['type' => 'text'],
            'visitor_identity' => ['type' => 'text'],
            'operating_system' => ['type' => 'text'],
            'browser'          => ['type' => 'text'],
            'browser_version'  => ['type' => 'text'],
            'device_name'      => ['type' => 'text'],
            'leave_time'       => ['type' => 'text'],
            'is_robot'         => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("is_robot")
            ],
            'is_desktop'       => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("is_desktop")
            ],
            'is_phone'         => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("is_phone")
            ],
            'status'           => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("status")
            ],
        ];
    }

    public function getClientFormFields()
    {
        return [
            'mobile'           => [
                'type'        => 'text',
                'placeholder' => '请输入手机号'
            ],
            //            'login_name'       => ['type' => 'text', 'placeholder' => '请输入手机号'],
            'login_pwd'        => [
                'type'        => 'password',
                'placeholder' => '请输入密码',
                'help'        => '如修改密码,输入新密码即可!默认: 123456'
            ],
            //            'access_token' => ['type' => 'text'],
            //            'expiry'       => ['type' => 'text'],
            'nickname'         => ['type' => 'text'],
            'role'             => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("role")
            ],
            'avatar'           => [
                'type' => 'file-image',
                'help' => '请上传 300*300px 尺寸的头像！'
            ],
            //            'mail'       => ['type' => 'text'],
            'qq'               => ['type' => 'text'],
            'sex'              => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("sex")
            ],
            //            'amount'           => ['type' => 'text'],
            //            'point'            => ['type' => 'text'],
            //            'ua'               => ['type' => 'text'],
            //            'vip'              => ['type'      => 'liveSearch',
            //                                   'data-size' => 8,
            //                                   'data'      => $this->getFieldStatusData("vip")
            //            ],
            'vip'              => [
                'type' => 'select',
                'data' => $this->getFieldStatusData("vip")
            ],
            //            'last_access_ip'   => ['type' => 'text'],
            //            'last_access_time' => ['type' => 'text'],
            //            'city'             => ['type' => 'text'],
            //            'referer'          => ['type' => 'text'],
            //            'channel'          => ['type' => 'text'],
            //            'visits'           => ['type' => 'text'],
            //            'online_time'      => ['type' => 'text'],
            //            'from_user_id'     => ['type' => 'text'],
            //            'extend_info'      => ['type' => 'text'],
            //            'visitor_identity' => ['type' => 'text'],
            //            'operating_system' => ['type' => 'text'],
            //            'browser'          => ['type' => 'text'],
            //            'browser_version'  => ['type' => 'text'],
            //            'device_name'      => ['type' => 'text'],
            //            'leave_time'       => ['type' => 'text'],
            'allow_watch_time' => [
                'type' => 'text',
                'help' => '请输入数字，以秒为单位！'
            ],
            //            'is_robot'         => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_robot")],
            //            'is_desktop'       => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_desktop")],
            //            'is_phone'         => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_phone")],
            'status'           => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("status")
            ],
        ];
    }

    public function getVisitorFormFields()
    {
        return [
            'mobile'           => [
                'type'        => 'text',
                'placeholder' => '请输入手机号'
            ],
            //            'login_name'       => ['type' => 'text', 'placeholder' => '请输入手机号'],
            'login_pwd'        => [
                'type'        => 'password',
                'placeholder' => '请输入密码',
                'help'        => '如修改密码,输入新密码即可!默认: 123456'
            ],
            //            'access_token' => ['type' => 'text'],
            //            'expiry'       => ['type' => 'text'],
            'nickname'         => ['type' => 'text'],
            'role'             => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("role")
            ],
            'avatar'           => [
                'type' => 'file-image',
                'help' => '请上传 300*300px 尺寸的头像！'
            ],
            //            'mail'       => ['type' => 'text'],
            'qq'               => ['type' => 'text'],
            'sex'              => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("sex")
            ],
            //            'amount'           => ['type' => 'text'],
            //            'point'            => ['type' => 'text'],
            //            'ua'               => ['type' => 'text'],
            //            'ip'               => ['type' => 'text'],
            //            'last_access_ip'   => ['type' => 'text'],
            //            'last_access_time' => ['type' => 'text'],
            //            'city'             => ['type' => 'text'],
            //            'referer'          => ['type' => 'text'],
            //            'channel'          => ['type' => 'text'],
            //            'visits'           => ['type' => 'text'],
            //            'online_time'      => ['type' => 'text'],
            //            'from_user_id'     => ['type' => 'text'],
            //            'extend_info'      => ['type' => 'text'],
            //            'visitor_identity' => ['type' => 'text'],
            //            'operating_system' => ['type' => 'text'],
            //            'browser'          => ['type' => 'text'],
            //            'browser_version'  => ['type' => 'text'],
            //            'device_name'      => ['type' => 'text'],
            //            'leave_time'       => ['type' => 'text'],
            'allow_watch_time' => [
                'type' => 'text',
                'help' => '请输入数字，以秒为单位！'
            ],
            //            'is_robot'         => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_robot")],
            //            'is_desktop'       => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_desktop")],
            //            'is_phone'         => ['type' => 'radio', 'data' => $this->getFieldStatusData("is_phone")],
            'status'           => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("status")
            ],
        ];
    }


    public function getAssistantFormFields($type = 'create')
    {
        $fields = [
            'mobile'    => [
                'type'        => 'text',
                'placeholder' => '请输入手机号'
            ],
            'login_pwd' => [
                'type'        => 'password',
                'placeholder' => '请输入密码',
                'help'        => '如修改密码,输入新密码即可!默认: 123456'
            ],
            'nickname'  => [
                'type'        => 'text',
                'placeholder' => '请输入昵称'
            ],
            'qq'        => [
                'type'        => 'text',
                'placeholder' => '请输入QQ号'
            ],
            'role'      => ['type' => 'hidden'],
            'avatar'    => [
                'type' => 'file-image',
                'help' => '请上传 300*300px 尺寸的头像！'
            ],
            'sex'       => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("sex")
            ],
            'status'    => [
                'type' => 'radio',
                'data' => $this->getFieldStatusData("status")
            ],
            //            'login_name' => ['type' => 'text', 'autocomplete' => 'off', 'placeholder' => '请手机号'],
        ];

        if ($type == 'update') {
            if (isset($fields['login_name'])) {
                $fields['login_name'] = array_merge($fields['login_name'], ['readonly' => true]);
            }
        }
        return $fields;
    }

    public function getFieldStatusData(string $field = '', $defaultVal = null)
    {
        $statusData = [
            'sex'        => [
                0 => '女',
                1 => '男',
                2 => '保密',
            ],
            'is_robot'   => [
                0 => '否',
                1 => '是',
            ],
            'is_desktop' => [
                0 => '否',
                1 => '是',
            ],
            'is_phone'   => [
                0 => '否',
                1 => '是',
            ],
            'status'     => [
                1 => '正常',
                2 => '黑名单',
                3 => '禁言',
            ],
            'role'       => [
                'admin'     => '管理员',
                'teacher'   => '讲师',
                'leader'    => '总监',
                'inspector' => '巡管',
                'anchor'    => '主播',
                'assistant' => '助理',
                'robot'     => '机器人',
                'client'    => '客户',
                'visitor'   => '访客',
            ],
        ];
//        switch ($field) {
//            case 'referer_name':
//                $dataMap = Yii::$app->params[__FUNCTION__ . $field] ?? [];
//                if (empty($dataMap)) {
//                    $items = Yii::$app->params['ItvChannels'] ?? ItvChannel::find()->all();
//                    foreach ($items as $item) {
//                        if ($item->domain) {
//                            $dataMap[$item->domain] = $item->referer_name;
//                        }
//                    }
//                    !isset(Yii::$app->params['ItvChannels']) && Yii::$app->params['ItvChannels'] = $items;
//                    !empty($dataMap) && Yii::$app->params[__FUNCTION__ . $field] = $dataMap;
//                }
//                $statusData['referer_name'] = $dataMap;
//                break;
//            case 'channel':
//                $dataMap = Yii::$app->params[__FUNCTION__ . $field] ?? [];
//                if (empty($dataMap)) {
//                    $items = Yii::$app->params['ItvChannels'] ?? ItvChannel::find()->all();
//                    foreach ($items as $item) {
//                        if ($item->domain) {
//                            $dataMap[$item->domain] = $item->name;
//                        }
//                    }
//                    !isset(Yii::$app->params['ItvChannels']) && Yii::$app->params['ItvChannels'] = $items;
//                    !empty($dataMap) && Yii::$app->params[__FUNCTION__ . $field] = $dataMap;
//                }
//                $statusData['channel'] = $dataMap;
//                break;
//            case 'vip':
//                $types = Yii::$app->params[__FUNCTION__ . $field] ?? [];
//                if (empty($types)) {
//                    $models = ItvUserGrade::find()->all();;
//                    if (count($models)) {
//                        foreach ($models as $model) {
//                            $types[$model->vip] = $model->grade_name;
//                        }
//                    }
//                    !empty($types) && Yii::$app->params[__FUNCTION__ . $field] = $types;
//                }
//                $statusData['vip'] = $types;
//                break;
//        }
        if (isset($statusData[$field])) {
            return $statusData[$field];
        }
        if (!is_null($defaultVal)) {
            return $defaultVal;
        }
        return '';
//        throw new \Exception('不存在该字段的状态配置!');
    }

    public function getFieldStatus(string $field = '', $status = '', $defaultVal = null)
    {
        if ($status === '') {
            throw new \Exception('状态值不能为空!');
        }
        $statusData = $this->getFieldStatusData($field, $defaultVal);
        if (isset($statusData[$status])) {
            return $statusData[$status];
        }
        if (!is_null($defaultVal)) {
            return $defaultVal;
        }
        return '';
//        throw new \Exception('不存在该字段的状态配置!');
    }

    public function loadDefautlValues()
    {
        $this->login_pwd = '123546';
    }

    public function beforeUpdate()
    {
        if (empty($this->access_token)) {
            $this->access_token = md5(time());
        }
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
        if ($this->mobile && !$this->login_name) {
            $this->login_name = $this->mobile;
        }
        if (empty($this->visitor_identity)) {
            $this->visitor_identity = md5(time());
        }
        if (empty($this->access_token)) {
            $this->access_token = md5(time());
        }
        if ($this->allow_watch_time >= 0) {
            $this->allow_watch_time = 30;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }
}
