<?php
/**
 * Created by PhpStorm.
 * User: CLZ
 * Date: 2018/1/9
 * Time: 上午12:32
 */

namespace app\components;

use Yii;

class RequestLock
{
    const LOCK_TIME = 30;

    /**
     * Created by CLZ
     * 加锁
     * @param $key
     * @throws \Exception
     */
    static function addLock($key){
        $lock = Yii::$app->redis->setnx($key,time());
        if(!$lock){
            $liveTime = Yii::$app->redis->ttl($key);
            if($liveTime==-1){
                static::deleteLock($key);
                throw new \Exception('请求过于频繁,请稍后再尝试!');
            }
            throw new \Exception('请求过于频繁,请稍后再尝试!');
        }else{
            Yii::$app->redis->expire($key,static::LOCK_TIME);
        }
    }

    /**
     * Created by CLZ
     * 解锁
     * @param $key
     */
    static function deleteLock($key){
        Yii::$app->redis->del($key);
    }

}