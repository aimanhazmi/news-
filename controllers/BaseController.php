<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2017/12/11
 * Time: 20:43
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Controller;

class BaseController extends Controller
{
    public $userinfo;

    public $layout       = 'main';
    public $allowNoLogin = false;

    public function init()
    {
        parent::init();
    }

    /**
     * Created by lonisy@163.com
     * @param int $code
     * @param string $message
     * @return string
     */
    public function responseApiError(int $code = 1, string $message = '未知错误!')
    {
        Yii::error('responseApiError:' . $message, __METHOD__);
        $response = [
            'code'    => $code,
            'message' => $message,
        ];
        $this->setHeader();
        $this->checkResponseCallback($response);
        echo Json::encode($response);
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
        Yii::info('responseApi', __METHOD__);
        $response = [
            'code'    => 0, // 成功
            'message' => 'success',
            'content' => $data,
        ];
        // $this->setHeader();
        $this->checkResponseCallback($response);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->data   = $response;
        Yii::$app->response->send();
        return Yii::$app->end();
    }

    /**
     * Created by lonisy@163.com
     * @param $data
     */
    private function checkResponseCallback($response)
    {
        $callback = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : false;
        if (!$callback) {
            return;
        }
        $callback = htmlspecialchars($callback);
        echo $callback . "(" . Json::encode($response) . ");";
        return Yii::$app->end();
    }

    /**
     * Created by lonisy@163.com
     */
    private function setHeader()
    {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }

    //    /**
    //     * created by lonisy@163.com
    //     * 权限验证
    //     */
    //    public function beforeAction($action)
    //    {
    //        if (!parent::beforeAction($action)) {
    //            return false;
    //        }
    //        //获取当前用户
    //        $session        = Yii::$app->session;
    //        $this->userinfo = $session->get($this->sessionKey);
    //        //接口权限处理
    //        $controller_name = Yii::$app->controller->id;
    //        $action_name     = Yii::$app->controller->action->id;
    //        if($controller_name && $action_name){
    //            //需验证
    //            $data = $this->getMenuData($controller_name, $action_name);
    //            $menu = $data['identity'] ?? '';
    //            if($menu && $data['status']){
    //                if(empty($this->userinfo)){
    //                    return $this->redirect(['index/forbidden']);
    //                }
    //                if(!Yii::$app->apiAuth->checkPermission($this->userinfo['username'], $menu)){
    //                    //需验证权限
    //                    return $this->redirect(['index/forbidden']);
    //                }
    //            }
    //        }
    //        return true;
    //    }
    //
    //    private function getMenuData($c, $a)
    //    {
    //        $connection  = Yii::$app->db;
    //        $sql         = "select * from sys_resources where action = \"$c/$a\"";
    //        $command     = $connection->createCommand($sql);
    //        $res         = $command->queryOne();
    //        return $res;
    //    }

}