<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/12/2 0002
 * Time: 上午 11:44
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
    /***
     * 获得分类
     * @return array
     */
    public static function getCategoryAll()
    {
        $data = self::find()->all();
        if (empty($data)) return [];
        return ArrayHelper::toArray($data);
    }
}
