<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "sys_action_log".
 *
 * @property string $id
 * @property string $action
 * @property string $description
 * @property string $data
 * @property string $user_name
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class SysActionLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_action_log';
    }

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at', // 如果字段名不同自行填充
                'updatedAtAttribute' => 'updated_at',
                'value'              => time(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['action', 'description', 'user_name', 'ip'], 'string', 'max' => 255],
            [['data'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'description' => 'Description',
            'data' => 'Data',
            'user_name' => 'User Name',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
