<?php
/**
 * Created by PhpStorm.
 * User: lilei
 * Date: 2018/6/10
 * Time: 18:20
 * https://github.com/phpredis/phpredis
 */

namespace app\components;

use Yii;

class RedisToolkit
{
    private static $_instance;

    public static function getInstance()
    {
        try {
            if (self::$_instance instanceof \Redis && strtoupper(self::$_instance->ping()) == 'PONG') {
                return self::$_instance;
            } else {
                self::$_instance = new \Redis();
                self::$_instance->connect(Yii::$app->params['redis']['hostname'], Yii::$app->params['redis']['port']);
                if (isset(Yii::$app->params['redis']['password'])){
                    self::$_instance->auth(Yii::$app->params['redis']['password']);
                }
                self::$_instance->setOption(\Redis::OPT_PREFIX, Yii::$app->params['redis']['prefix']);
                self::$_instance->select(Yii::$app->params['redis']['database']);
                return self::$_instance;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}