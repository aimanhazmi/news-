<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/12/2 0002
 * Time: 上午 10:39
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Article extends ActiveRecord
{

    public function getArticleOne($id)
    {
        $data = self::findOne($id);
        return ArrayHelper::toArray($data);
    }


    public function getArticleCount()
    {
        $data = self::find()->max('id');
        return $data;
    }



    public function clearword($parms)
    {
        $data = self::findOne($parms['id']);
        $data->art_content=$parms['words'];
        $data->save();
        return ArrayHelper::toArray($data);
    }



    public function delArticleOne($id)
    {
        $data = self::findOne($id)->delete();
        return ArrayHelper::toArray($data);
    }




}