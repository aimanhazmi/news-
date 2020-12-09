<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/16
 * Time: 19:19
 */

namespace app\components;

class CurlToolkit
{
    public static function request($method, $url, $params = [], $conditions = [])
    {
        $conditions['userAgent']      = isset($conditions['userAgent']) ? $conditions['userAgent'] : '';
        $conditions['connectTimeout'] = isset($conditions['connectTimeout']) ? $conditions['connectTimeout'] : 10;
        $conditions['timeout']        = isset($conditions['timeout']) ? $conditions['timeout'] : 10;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $conditions['userAgent']);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $conditions['connectTimeout']);
        curl_setopt($curl, CURLOPT_TIMEOUT, $conditions['timeout']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, 1);
            //TODO  POST 请求转码 http_build_query
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        } else if ($method == 'PUT') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } else if ($method == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } else if ($method == 'PATCH') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } else {
            if (!empty($params)) {
                $url = $url . (strpos($url, '?') ? '&' : '?') . http_build_query($params);
            }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($curl);
        $curlinfo = curl_getinfo($curl);

        $header = substr($response, 0, $curlinfo['header_size']);
        $body   = substr($response, $curlinfo['header_size']);

        curl_close($curl);

        if (empty($curlinfo['namelookup_time'])) {
            return $curlinfo;
            return [];
        }
        if (isset($conditions['contentType']) && $conditions['contentType'] == 'plain') {
            return $body;
        }
        $body = json_decode($body, true);
        if (is_array($body)) {
            return $body;
        }
        return $curlinfo;
    }
}
