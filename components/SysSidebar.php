<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/24
 * Time: 16:38
 */

namespace app\components;

use yii\helpers\Url;

class SysSidebar
{
    public static function getList()
    {
        return [];
    }

    public static function getPagePath($pathinfo)
    {
        return self::makePagePath(self::getList(), $pathinfo);
    }

    public static function makePagePath($items, $pathinfo)
    {
        $array = [];
        foreach ($items as $item) {
            if (isset($item['pathinfo'])) {
                if ($item['pathinfo'] == $pathinfo) {
                    $array[] = $item;
                    break;
                } else if (isset($item['children'])) {
                    $result = self::makePagePath($item['children'], $pathinfo);
                    if ($result) {
                        unset($item['children']);
                        $array[] = $item;
                        $array   = array_merge($array, $result);
                        break;
                    }
                }
            }
        }
        return $array;
    }
}