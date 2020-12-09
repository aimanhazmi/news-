<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/3/19
 * Time: 19:16
 */

namespace app\components;


class CommonToolkit
{
    public static function getClientIp()
    {
        if (isset($_SERVER["HTTP_YZ_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_YZ_CLIENT_IP"];
        } else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            $ip = explode(',', $ip);
            $ip = $ip[0];
            $ip = trim($ip);
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $ip = getenv("REMOTE_ADDR");
        } else if (isset($_SERVER ['REMOTE_ADDR']) && $_SERVER ['REMOTE_ADDR'] && strcasecmp($_SERVER ['REMOTE_ADDR'], "unknown")) {
            $ip = $_SERVER ['REMOTE_ADDR'];
        } else {
            $ip = "127.0.0.1";
        }
        return trim($ip);
    }

    public static function filterEmoji($str)
    {
        $str = preg_replace_callback('/./u', function(array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        }, $str);

        return $str;
    }

    public static function verfiySign(array $parameter = [], string $signKey = '')
    {
        if (!isset($parameter['sign'])) {
            throw new \Exception('缺少验签字段!');
        }
        $sign = self::genVerify($parameter, $signKey);
        if ($sign != $parameter['sign']) {
            return false;
        }
        return true;
    }


    public static function genVerify(array $parameter = [], string $signKey = '')
    {
        if (isset($parameter['sign'])) {
            unset($parameter['sign']);
        }
        if (empty($parameter)) {
            throw new \Exception('验签的数据格式错误!');
        }
        ksort($parameter);
        $signString = http_build_query($parameter, '&');
        $signString = md5($signString . $signKey);
        return $signString;
    }

    public static function getLocation($ip = '')
    {
        if (empty($ip)) {
            return '本机地址';
        }
        if ($ip == "127.0.0.1")
            return "本机地址";
        if (YII_ENV == "dev")
            return "本机地址";

        $ip_info = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
        $ip_info = json_decode($ip_info, true);
        if (isset($ip_info['data']['country']) && isset($ip_info['data']['city'])) {
            return $ip_info['data']['country'] . $ip_info['data']['city'];
        }
    }

    public static function makeUrl($params = [], $pageUrl, $pageInfo)
    {
        if (!empty($pageInfo['current']) && isset($params['page_no'])) {
            if ($pageInfo['current'] == $params['page_no']) {
                return "javascript:void(0);";
            }
        }
        if ($params['page_no'] > 1) {
            $params = array_merge($_GET, $params);
        } else {
            if (isset($params['page_no'])) {
                unset($params['page_no']);
            }
            if (isset($_GET['page_no'])) {
                unset($_GET['page_no']);
            }
            $params = $_GET;
        }
        if (isset($params['id'])) {
            unset($params['id']);
        }
        return $pageUrl . (!empty($params) ? ('?' . http_build_query($params)) : '');
    }
}