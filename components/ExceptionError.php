<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2017/12/22
 * Time: 20:41
 */

namespace app\components;

use Yii;

class ExceptionError
{
    public static function code($msg)
    {
        // 错误代码,说明
        $errors = [
            0 => '未定义错误!',
            1 => '成功!',
            2 => '系统异常',
            10 => '缺失 token 参数！',
            11 => 'token失效',
            100 => '参数缺失或无效.',
            101 => '非法请求',
            500 => '用户不存在或密码错误',
            501 => '该商品库存不足',
            502 => '该商品无效',
            503 => '支付方式异常',
            504 => '该订单已完成',
            505 => '没有数据',
            506 => '余额不足',
            507 => '游戏货币不足',
            508 => '背包内礼物数量不足',
            509 => '需要验证码登陆! ',
            510 => '账号不存在',
            511 => '密码错误',
            512 => '账号被封停',
            513 => '验证码错误! ',
            514 => '帐号已存在',
            515 => '需要验证码注册! ',
            516 => '活动未开启',
            517 => '房间不存在'
            // XXX => '缺失 app_key 参数!',   // 统用格式
        ];
        $errors = array_flip($errors);
        return isset($errors[$msg]) ? $errors[$msg] : 0;
    }

    /**
     * Created by CLZ
     * 处理service报错
     * @param \Exception $e
     * @param string $default_message
     * @throws \Exception
     */
    public static function serviceErrorHandler(\Exception $e, string $default_message = "系统异常")
    {
        if ($e->getCode() == -1) {
            throw new \Exception($e->getMessage(), -1);
        } else {
            $error_message = "file:" . $e->getFile() . " | line:" . $e->getLine() . " | message:" . $e->getMessage();
            Yii::error($error_message);
            throw new \Exception($e->getMessage(), -1);
        }
    }
}