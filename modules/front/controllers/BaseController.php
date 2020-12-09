<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:28:44
 */

namespace app\modules\front\controllers;

use Yii;
use yii\web\Controller;
use app\service\ArticleService;
use app\modules\admin\service\CategoryService;
use app\modules\admin\service\SysSiteService;
use yii\helpers\ArrayHelper;

class BaseController extends Controller
{
    public $layout = 'main';

    public function init()
    {
        parent::init();
        $this->initSiteInfo();
        $this->initCategorysInfo();
    }

    public function initSiteMeta($params = [])
    {
        // 合并信息
        $mateKeys = ['title', 'description', 'keywords'];
        foreach ($mateKeys as $mateKey) {
            if (isset($params[$mateKey])) {
                YII::$app->view->params[$mateKey] = $params[$mateKey];
            }
        }
    }

    private function initSiteInfo()
    {
        // 站点信息
        $redis         = Yii::$app->redis;
        $siteinfo_Result = $redis->keys('index:siteinfo');
   
        if($siteinfo_Result){
          $siteinfo_itemsResult = $redis->get('index:siteinfo');
          $siteInfo=ArrayHelper::toArray(json_decode($siteinfo_itemsResult)); 
           
        }else{

        $siteInfo = SysSiteService::getInstance()->getModelById(1);
        $siteInfo=ArrayHelper::toArray($siteInfo); 
       // $redis->set('index:siteinfo',json_encode($siteInfo)); 
        }

        
        if ($siteInfo) {
            YII::$app->view->params += $siteInfo;
        }
    }




    private function initCategorysInfo()
    {


     $redis         = Yii::$app->redis;
     $categorys_Result = $redis->keys('index:categorys');

     if($categorys_Result){
        $categorys_itemsResult = $redis->get('index:categorys');
        $categorys=ArrayHelper::toArray(json_decode($categorys_itemsResult)); 
        
     }else{
        
         $categoryTopId     = 1;  // 总分类
         $category          = CategoryService::getInstance()->getModelById($categoryTopId);
         $categorys         = CategoryService::getInstance()->search(['parent_id' => $category->id]);
      //   $redis->set('index:categorys',json_encode($categorys));  

     }


    if ($categorys) {
        YII::$app->view->params += $categorys;
      }

    }



    /**
     * Created by lonisy@163.com
     * @param int $code
     * @param string $message
     * @return string
     */
    public function responseApiError(int $code = 1, string $message = '未知错误!')
    {
        $response = [
            'code'    => $code,
            'message' => $message,
        ];
        Yii::$app->response->data   = $response;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->send();
        return Yii::$app->end();
    }
    /**
     * Created by lonisy@163.com
     * @param $data
     * @return string
     */
    public function responseApi($data)
    {
        if (Yii::$app->request->isAjax == false) {
            $this->responseApiError(1, '非法请求!');
        }
        $response = [
            'code'    => 0, // 2成功
            'message' => 'success',
            'content' => $data,
        ];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->data   = $response;
        Yii::$app->response->send();
        return Yii::$app->end();
    }

    /***
     * 数组某个值为键值
     * @param $arr array 待处理数组
     * @param $key string 键值
     * @return array
     */
    protected function arrayIdAsKey($arr, $key)
    {
        $data = [];
        foreach ($arr as $val) {
            $data[$val[$key]] = $val;
        }
        return $data;
    }

    /***
     * 调试输出用
     * @param $msg
     */
    public function dump($msg)
    {
        echo "<pre>";
        var_dump($msg);
        exit();
    }
}