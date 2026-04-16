<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/2/1
 * Time: 11:09
 */

namespace app\components;

class SidebarToolkit
{
    /**
     * @param array  $data
     * @param        $sort
     * @param int    $parentId
     * @param string $parentKey
     *
     * @return array
     */
    public static function makeTree(array $data, $sort, $parentId = 0, $parentKey = 'parent_id', $grade = 1)
    {

        $tree = self::makeParentTree($data, $sort, $parentId, $parentKey);
        foreach ($tree as $key => $item) {

            $children = self::makeTree($data, $sort, $item['id'], $parentKey, $grade + 1);
            if (!empty($children)) {
                $tree[$key]['items'] = $children;
                $arrowHtml           = '<span class="fa arrow"></span>';
            } else {
                $arrowHtml = '';
            }
            $tree[$key]['grade'] = $grade;
            $nextGrade           = $grade + 1;
            if ($nextGrade == 2) {
                $tree[$key]['submenuTemplate'] = "\n<ul class='nav nav-second-level collapse'>\n{items}\n</ul>\n";
            } else if ($nextGrade == 3) {
                !empty($children) && $tree[$key]['icon'] = 'fa fa-angle-right';
                $tree[$key]['submenuTemplate'] = "\n<ul class='nav nav-third-level collapse'>\n{items}\n</ul>\n";
            } else if ($nextGrade == 4) {
                $tree[$key]['icon'] = 'fa fa-angle-double-right';
            }
            $tree[$key]['label']    = '<i class="' . $tree[$key]['icon'] . '"></i><span class="menu-title">' . $tree[$key]['label'] . '</span>' . $arrowHtml;
            $target                 = !empty($item['target']) ? ('target="' . $item['target'] . '"') : '';
            $tree[$key]['template'] = '<a href="{url}" ' . $target . '>{label}</a>';
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

        array_multisort($sortArray, SORT_DESC, $filtered);

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
