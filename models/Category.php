<?php
/**
 * Created by PhpStorm.
 * User: Wht
 * Date: 2018/12/2 0002
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
    public function getCategoryAll()
    {
        $data = self::find()->all();
        if (empty($data)) return [];
        return ArrayHelper::toArray($data);
    }
}