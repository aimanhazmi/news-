<?php

use yii\db\Migration;

/**
 * Class m180417_123830_itv
 */
class m180417_123830_itv extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 ENGINE=InnoDB';
        }
        $this->createTable('{{%itv_users}}', [
            'id'               => $this->bigPrimaryKey()->unsigned()->comment('主键ID'),
            'login_name'       => $this->string(64)->defaultValue('')->comment('登录名'),
            'login_pwd'        => $this->string(128)->defaultValue('')->comment('密码'),
            'access_token'     => $this->string(128)->defaultValue('')->comment('令牌'),
            'expiry'           => $this->integer()->unsigned()->defaultValue(0)->comment('令牌有效期时间戳'),
            'nickname'         => $this->string(64)->defaultValue('')->comment('昵称'),
            'mobile'           => $this->string(64)->defaultValue('')->comment('手机号'),
            'role'             => $this->string(64)->defaultValue('')->comment('角色: admin; teacher; anchor; assistant; robot; client;'),
            'avatar'           => $this->string(255)->defaultValue('')->comment('头像'),
            'mail'             => $this->string(64)->defaultValue('')->comment('mail'),
            'qq'               => $this->string(64)->defaultValue('')->comment('qq'),
            'vip'              => $this->integer()->unsigned()->defaultValue(0)->comment('VIP等级'),
            'sex'              => $this->integer()->unsigned()->defaultValue(0)->comment('性别: 0=>女; 1=>男; 2=>保密'),
            'amount'           => $this->bigInteger()->unsigned()->defaultValue(0)->comment('余额'),
            'point'            => $this->bigInteger()->unsigned()->defaultValue(0)->comment('积分'),
            'ua'               => $this->string()->defaultValue('')->comment('浏览器 User-Agent'),
            'ip'               => $this->string()->defaultValue('')->comment('来源 IP'),
            'last_access_ip'   => $this->string()->defaultValue('')->comment('末次访问 IP'),
            'last_access_time' => $this->integer()->unsigned()->defaultValue(0)->comment('末次访问时间戳'),
            'city'             => $this->string()->defaultValue('')->comment('所在地'),
            'referer'          => $this->string()->defaultValue('')->comment('来源网址'),
            'channel'          => $this->string()->defaultValue('')->comment('推广渠道'),
            'visits'           => $this->integer()->unsigned()->defaultValue(0)->comment('访问次数'),
            'online_time'      => $this->integer()->unsigned()->defaultValue(0)->comment('在线时长'),
            'from_user_id'     => $this->bigInteger()->unsigned()->defaultValue(0)->comment('FROM_USER_ID'),
            'extend_info'      => $this->string(2000)->defaultValue('')->comment('扩展参数'),
            'visitor_identity' => $this->string()->defaultValue('')->comment('客户端身份标示'),
            'operating_system' => $this->string()->defaultValue('')->comment('操作系统'),
            'browser'          => $this->string()->defaultValue('')->comment('浏览器'),
            'browser_version'  => $this->string()->defaultValue('')->comment('浏览器版本'),
            'device_name'      => $this->string()->defaultValue('')->comment('设备名称'),
            'leave_time'       => $this->integer()->unsigned()->defaultValue(0)->comment('离开时间'),
            'is_robot'         => $this->integer()->unsigned()->defaultValue(0)->comment('机器人: 0=>否; 1=>是'),
            'is_desktop'       => $this->integer()->unsigned()->defaultValue(0)->comment('桌面设备: 0=>否; 1=>是'),
            'is_phone'         => $this->integer()->unsigned()->defaultValue(0)->comment('手机用户: 0=>否; 1=>是'),
            'status'           => $this->integer()->unsigned()->defaultValue(1)->comment('状态: 0=>禁用; 1=>启用'),
            'created_at'       => $this->integer()->unsigned()->defaultValue(0)->comment('创建时间戳'),
            'updated_at'       => $this->integer()->unsigned()->defaultValue(0)->comment('更新时间戳'),
        ], $tableOptions);
        $this->addCommentOnTable('itv_users', '用户表');

        $this->createTable('{{%itv_rooms}}', [
            'id'                 => $this->bigPrimaryKey()->unsigned()->comment('主键ID'),
            'room_title'         => $this->string()->defaultValue('')->comment('房间标题'),
            'keywords'           => $this->string()->defaultValue('')->comment('关键字'),
            'description'        => $this->string()->defaultValue('')->comment('描述'),
            'user_id'            => $this->bigInteger()->unsigned()->defaultValue(0)->comment('管理员 ID'),
            'cover'              => $this->string()->defaultValue('')->comment('封面'),
            'thumbnail'          => $this->string()->defaultValue('')->comment('缩略图'),
            'room_notice'        => $this->string()->defaultValue('')->comment('滚动预告'),
            'room_placard'       => $this->string()->defaultValue('')->comment('公告'),
            'visitor_watch_time' => $this->integer()->unsigned()->defaultValue(0)->comment('游客观看时长'),
            'add_cardinal'       => $this->integer()->unsigned()->defaultValue(0)->comment('观看人数基数'),
            'watch_num'          => $this->integer()->unsigned()->defaultValue(0)->comment('观看人数'),
            'extend_info'        => $this->string(2000)->defaultValue('')->comment('扩展参数'),
            'im_review'          => $this->integer()->unsigned()->defaultValue(1)->comment('聊天审核: 0=>不审核; 1=>审核'),
            'status'             => $this->integer()->unsigned()->defaultValue(1)->comment('状态: 0=>禁用; 1=>启用'),
            'created_at'         => $this->integer()->unsigned()->defaultValue(0)->comment('创建时间戳'),
            'updated_at'         => $this->integer()->unsigned()->defaultValue(0)->comment('更新时间戳'),
        ], $tableOptions);
        $this->addCommentOnTable('itv_rooms', '房间表');
    }

    public function down()
    {
        $this->dropTable('{{%itv_users}}');
        $this->dropTable('{{%itv_rooms}}');
    }
}
