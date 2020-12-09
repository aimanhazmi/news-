<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-06
 * Time: 11:08
 */
namespace  app\modules\broadcast\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\service\SysSiteService;
use app\modules\admin\service\CategoryService;

class BaseController extends Controller {
    public $layout = 'main';
    public $itemsSize  = 8;                                     //每页条数
    protected $caseCategory = 16;                               //案例分类ID
    protected $activityCategory = 11;                           //动态分类ID
    public $pos = [130,131,132,133,134,135,136,137,222,220];    //位置数组

    public function init()
    {
        parent::init();
        $this->initSiteInfo();
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
        $siteInfo = SysSiteService::getInstance()->getModelById(1);
        // 案例和动态
        $hCaseCategory = CategoryService::getInstance()->search(['parent_id' => $this->caseCategory]);
        $hActivityCategory = CategoryService::getInstance()->search(['parent_id' => $this->activityCategory]);
        if ($siteInfo) {
            YII::$app->view->params += $siteInfo->toArray();
        }
        if ($hCaseCategory) {
            YII::$app->view->params["cases"] = array_reverse($hCaseCategory["items"]);
        }
        if ($hActivityCategory) {
            YII::$app->view->params["news"] = array_reverse($hActivityCategory["items"]);
        }
    }


    public function render($view, $params = [])
    {
        if($view == "") $view = $this->action->id;
        $content = $this->getView()->render($view, $params, $this);
        return $this->renderContent($content);
    }

    /**
     * Created by lonisy@163.com
     * @param int $code
     * @param string $message
     * @return string
     */
    public function responseApiError($code = 1, $message = '未知错误!')
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