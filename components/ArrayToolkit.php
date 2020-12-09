<?php

/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/09/11
 * Time: 14:00
 */

namespace app\components;

class ArrayToolkit
{
    public static function column(array $array, $columnName)
    {
        if (empty($array)) {
            return array();
        }

        $column = array();

        foreach ($array as $item) {
            if (isset($item[$columnName])) {
                $column[] = $item[$columnName];
            }
        }

        return $column;
    }

    public static function parts(array $array, array $keys)
    {
        foreach (array_keys($array) as $key) {
            if (!in_array($key, $keys)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    public static function requireds(array $array, array $keys, $strictMode = false)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
            if ($strictMode && (is_null($array[$key]) || $array[$key] === "" || $array[$key] === 0)) {
                return false;
            }
        }

        return true;
    }

    public static function changes(array $before, array $after)
    {
        $changes = array('before' => array(), 'after' => array());

        foreach ($after as $key => $value) {
            if (!isset($before[$key])) {
                continue;
            }

            if ($value != $before[$key]) {
                $changes['before'][$key] = $before[$key];
                $changes['after'][$key]  = $value;
            }
        }

        return $changes;
    }

    public static function group(array $array, $key)
    {
        $grouped = array();

        foreach ($array as $item) {
            if (empty($grouped[$item[$key]])) {
                $grouped[$item[$key]] = array();
            }

            $grouped[$item[$key]][] = $item;
        }

        return $grouped;
    }

    public static function index(array $array, $name)
    {
        $indexedArray = array();

        if (empty($array)) {
            return $indexedArray;
        }

        foreach ($array as $item) {
            if (isset($item[$name])) {
                $indexedArray[$item[$name]] = $item;
                continue;
            }
        }

        return $indexedArray;
    }

    public static function rename(array $array, array $map)
    {
        $keys = array_keys($map);

        foreach ($array as $key => $value) {
            if (in_array($key, $keys)) {
                $array[$map[$key]] = $value;
                unset($array[$key]);
            }
        }

        return $array;
    }

    public static function filter(array $array, array $specialValues)
    {
        $filtered = array();

        foreach ($specialValues as $key => $value) {
            if (!array_key_exists($key, $array)) {
                continue;
            }

            if (is_array($value)) {
                $filtered[$key] = (array)$array[$key];
            } elseif (is_int($value)) {
                $filtered[$key] = (int)$array[$key];
            } elseif (is_float($value)) {
                $filtered[$key] = (float)$array[$key];
            } elseif (is_bool($value)) {
                $filtered[$key] = (bool)$array[$key];
            } else {
                $filtered[$key] = (string)$array[$key];
            }

            if (empty($filtered[$key])) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }

    public static function trim($array)
    {
        if (!is_array($array)) {
            return $array;
        }
        
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = ArrayToolkit::trim($value);
            } elseif (is_string($value)) {
                $array[$key] = trim($value);
            }
        }

        return $array;
    }

    public static function every($array, $callback = null)
    {
        foreach ($array as $value) {
            if (is_null($callback) && !$value) {
                return false;
            } else if (is_callable($callback) && !$callback($value)) {
                return false;
            }
        }
        return true;
    }

    public static function some($array, $callback = null)
    {
        foreach ($array as $value) {
            if (is_null($callback) && $value) {
                return true;
            } else if (is_callable($callback) && $callback($value)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Created by lonisy@163.com
     * @param array $arr 将要排序的数组
     * @param string $keys 指定排序的key
     * @param string $type 排序类型 asc | desc
     * @return array
     */
    public static function arraySort($arr, $keys, $type = 'asc')
    {
        $keysvalue = $new_array = array();
        foreach ($arr as $k => $v) {
            $keysvalue[$k] = $v[$keys];
        }
        $type == 'asc' ? asort($keysvalue) : arsort($keysvalue);
        reset($keysvalue);
        foreach ($keysvalue as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }

    /**
     * Created by lonisy@163.com
     * 根据某一特定键(下标)取出一维或多维数组的所有值；不用循环的理由是考虑大数组的效率，把数组序列化，然后根据序列化结构的特点提取需要的字符串
     * @param array $array
     * @param $string
     * @return bool
     */
    public static function arrayGetByKey(array $array, $string)
    {
        if (!trim($string)) return false;
        preg_match_all("/\"$string\";\w{1}:(?:\d+:|)(.*?);/", serialize($array), $res);
        return $res[1];
    }
}
