<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/3/22
 * Time: 18:59
 */

namespace app\service;

use Yii;

class SmsService
{
    public static function curlQuery($url, $postTag = false, $postData = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if ($postTag) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function genVerify($data, $signKey)
    {
        ksort($data);
        $items = array();
        foreach ($data as $key => $value) {
            $items[] = $key . "=" . $value;
        }

        return md5(join("&", $items) . $signKey);
    }

    public static function sendSMSMsg($mobile, $content)
    {
        if (empty($content)) {
            throw new \Exception('短信内容不能为空!');
        }
        $postArr           = array(
            'app_id'  => Yii::$app->params['smsParams']['app_id'],
            'mobile'  => $mobile,
            'content' => $content,
            'time'    => time(),
        );
        $postArr['verify'] = self::genVerify($postArr, Yii::$app->params['smsParams']['app_key']);
        $postUrl           = 'http://sms.test.com/api/sp/sendSMS?' . http_build_query($postArr);
        $postRst           = self::curlQuery($postUrl);
        $rst               = json_decode($postRst, true);
        if (empty($rst) || $rst['status'] != 0) {
            throw new \Exception('短信发送失败: 相关手机号=>' . $mobile);
        }
        return true;
    }
}

?>
