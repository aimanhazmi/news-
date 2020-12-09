<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/2/1
 * Time: 11:09
 */

namespace app\components;

class TreeToolkit
{
    /**
     * @param array  $data
     * @param        $sort
     * @param int    $parentId
     * @param string $parentKey
     *
     * @return array
     */
    public static function makeTree(array $data, $sort, $parentId = 0, $parentKey = 'parent_id')
    {
        $tree = self::makeParentTree($data, $sort, $parentId, $parentKey);

        foreach ($tree as $key => $value) {
            $tree[$key]['children'] = self::makeTree($data, $sort, $value['id'], $parentKey);
        }

        return $tree;
    }

    /**
     * @param array $data
     * @param       $sort
     * @param       $parentId
     * @param       $parentKey
     * @return array
     */
    private static function makeParentTree(array $data, $sort, $parentId, $parentKey)
    {
        $filtered = [];

        if (empty($parentId)) {
            $parentIds = self::generateParentId($data, $parentKey);
        }

        foreach ($data as $value) {
            if ($value[$parentKey] == $parentId) {
                $filtered[] = $value;
            }
        }

        $sortArray = ArrayToolkit::column($filtered, $sort);

        array_multisort($sortArray, $filtered, SORT_DESC);

        return $filtered;
    }

    /**
     * Description: generateParentId
     * @param $data
     * @param $parentKey
     * @return mixed
     */
    private static function generateParentId($data, $parentKey)
    {
        $parentIds = ArrayToolkit::column($data, $parentKey);
        sort($parentIds);

        return array_shift($parentIds);
    }
}
