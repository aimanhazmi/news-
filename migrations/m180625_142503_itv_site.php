<?php

use yii\db\Migration;

/**
 * Class m180625_142503_itv_site
 */
class m180625_142503_itv_site extends Migration
{


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 ENGINE=InnoDB';
        }
        $this->createTable('{{%itv_site}}', [
            'id'               => $this->primaryKey()->unsigned()->comment('主键ID'),
            'site_name'        => $this->string(255)->defaultValue('')->comment('站点名称'),
            'site_logo'        => $this->string(255)->defaultValue('')->comment('站点logo'),
            'site_qrcode'      => $this->string(255)->defaultValue('')->comment('公众号二维码'),
            'site_qq'          => $this->string(255)->defaultValue('')->comment('客服 QQ'),
            'site_phone'       => $this->string(255)->defaultValue('')->comment('客服手机号'),
            'ad0'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad1'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad2'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad3'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad4'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad5'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad6'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad7'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad8'              => $this->string(255)->defaultValue('')->comment('广告'),
            'ad9'              => $this->string(255)->defaultValue('')->comment('广告'),
            'statistical_code' => $this->string(2000)->defaultValue('')->comment('统计代码'),
            'safe_warning'     => $this->string(255)->defaultValue('')->comment('安全提示'),
            'open_reg'         => $this->integer()->unsigned()->defaultValue(1)->comment('状态: 0=>关闭注册; 1=>开放注册'),
            'service_status'   => $this->integer()->unsigned()->defaultValue(1)->comment('状态: 0=>停站维护; 1=>运行中'),
        ], $tableOptions);
        $this->addCommentOnTable('itv_site', '站点设置表');

        $this->createTable('{{%itv_teachers}}', [
            'id'           => $this->primaryKey()->unsigned()->comment('主键ID'),
            'nickname'     => $this->string(255)->defaultValue('')->comment('讲师昵称'),
            'title'        => $this->string(255)->defaultValue('')->comment('头衔'),
            'avatar'       => $this->string(255)->defaultValue('')->comment('头像'),
            'qrcode'       => $this->string(255)->defaultValue('')->comment('微信二维码'),
            'qq'           => $this->string(255)->defaultValue('')->comment('QQ'),
            'phone'        => $this->string(255)->defaultValue('')->comment('手机号'),
            'links'        => $this->string(255)->defaultValue('')->comment('个人主页'),
            'integral'     => $this->integer()->unsigned()->defaultValue(0)->comment('积分'),
            'introduction' => $this->text()->comment('讲师介绍'),
            'description'  => $this->text()->comment('讲师描述'),
            'status'       => $this->integer()->unsigned()->defaultValue(1)->comment('状态: 0=>禁用; 1=>启用'),
            'created_at'   => $this->integer()->unsigned()->defaultValue(0)->comment('创建时间戳'),
            'updated_at'   => $this->integer()->unsigned()->defaultValue(0)->comment('更新时间戳'),
        ], $tableOptions);
        $this->addCommentOnTable('itv_teachers', '讲师表');
    }

    public function down()
    {
        $this->dropTable('{{%itv_site}}');
        $this->dropTable('{{%itv_teachers}}');
    }


}
