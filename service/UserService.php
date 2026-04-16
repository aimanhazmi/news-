<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/4/26
 * Time: 16:28
 */

namespace app\service;


use app\components\ArrayToolkit;
use app\components\CommonToolkit;
use app\models\itv\ItvUsers;
use Jenssegers\Agent\Agent;
use GeoIp2\Database\Reader;
use Yii;

class UserService
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function login(array $params = [])
    {
        $params = array_filter($params);
        if (isset($params['mobile'])) {
            $paramsKeys = ['mobile', 'login_pwd'];
        } else if (isset($params['login_name'])) {
            $paramsKeys = ['login_name', 'login_pwd'];
        } else {
            throw new \Exception("缺失 mobile 参数! ");
        }
        foreach ($paramsKeys as $paramsKey) {
            if (!isset($params[$paramsKey])) {
                throw new \Exception("缺失 $paramsKey 参数! ");
            }
        }
        $where = ArrayToolkit::parts($params, ['login_name', 'mobile']);
        $user = ItvUsers::find()->where($where)->one();
        if (!$user) {
            if (isset($params['mobile'])) {
                throw new \Exception("该手机号未注册！");
            }
            if (isset($params['login_name'])) {
                throw new \Exception("用户不存在！");
            }
        }
        if ($params['login_pwd'] != $user->login_pwd) {
            if (password_verify($params['login_pwd'], $user->login_pwd) == false) {
                throw new \Exception("密码错误！");
            }
        }
        return $user;
    }


    public function rememberLoginPassword()
    {
        $cookies = Yii::$app->response->cookies;
        $user = Yii::$app->view->params['userinfo'];
        $remember = $_GET['remember'] ?? 'noset';
        if ($remember == 'on' && isset($user->mobile)) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'login_name',
                'value' => $user->mobile,
                'expire' => time() + 86400 * 7
            ]));
            $cookies->add(new \yii\web\Cookie([
                'name' => 'login_pwd',
                'value' => $user->login_pwd,
                'expire' => time() + 86400 * 7
            ]));
            $cookies->add(new \yii\web\Cookie([
                'name' => 'login_remember',
                'value' => true,
                'expire' => time() + 86400 * 7
            ]));
        } else if ($remember == 'off') {
            $cookies->remove('login_name');
            $cookies->remove('login_pwd');
            $cookies->remove('login_remember');
        }
    }

    public function register(array $params = [])
    {
        $paramsKeys = ['login_name', 'login_pwd', 'mobile', 'nickname'];
        foreach ($paramsKeys as $paramsKey) {
            if (!isset($params[$paramsKey])) {
                throw new \Exception("缺失 $paramsKey 参数! ");
            }
        }
        $params['login_pwd'] = password_hash($params['login_pwd'], PASSWORD_DEFAULT);
        $model = new ItvUsers();
        $model->setAttributes($params);/*$model->attributes = $params;*/
        if ($model->save() == false) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
        return $model;
    }

    /**
     * Created by aiman
     * Date: 2025-04-27 22:52:18
     * Description: autoAnalysis
     * @return bool
     * @throws \Exception
     */
    public function autoAnalysis()
    {
        $cookies = Yii::$app->response->cookies;
        if (isset($_COOKIE['ACCESS_TOKEN'])) {
            $access_token = trim($_COOKIE['ACCESS_TOKEN']);
            $user = ItvUsers::find()->where(['access_token' => $access_token])->one();
        } else if (isset($_COOKIE['VISITOR_IDENTITY'])) {
            $user = ItvUsers::find()->where(['visitor_identity' => trim($_COOKIE['VISITOR_IDENTITY'])])->one();
        }
        if (isset($user) && $user) {
            $userData['last_access_ip'] = Yii::$app->request->getRemoteIP();
            $userData['last_access_time'] = time();
            $userData['visits'] = $user->visits + 1;
        } else {
            $user = new ItvUsers();
            $agent = new Agent();
            /*$reader           = new Reader(Yii::getAlias('@app') . '/web/data/GeoLite2-City_20180403/GeoLite2-City.mmdb');*/
            $userData['role'] = 'visitor';
            $userData['visits'] = 1;
            $userData['ua'] = Yii::$app->request->getUserAgent();
            $userData['ip'] = Yii::$app->request->getRemoteIP();
            $userData['city'] = CommonToolkit::getLocation($userData['ip']);
            $userData['referer'] = Yii::$app->request->getReferrer() ?? '';
            $userData['channel'] = '';
            $userData['from_user_id'] = $_COOKIE['REFEREE'] ?? '';
            $userData['from_user_id'] = $_REQUEST['REFEREE'] ?? '';
            $userData['from_user_id'] = !empty($userData['from_user_id']) ? base64_decode($userData['from_user_id']) : 0;
            $userData['visitor_identity'] = $_COOKIE['VISITOR_IDENTITY'] ?? md5(time() . rand(100, 999) . rand(100, 999));
            $userData['operating_system'] = $agent->platform() ?: '';
            $userData['browser'] = $agent->browser() ?: '';
            $userData['browser_version'] = $agent->version($userData['browser']) ?: '';
            $userData['device_name'] = $agent->device() ?: '';
            $userData['is_robot'] = $agent->isRobot() ? 1 : 0;
            $userData['is_desktop'] = $agent->isDesktop() ? 1 : 0;
            $userData['is_phone'] = $agent->isPhone() ? 1 : 0;
        }
        if (isset($userData)) {
            $user->setAttributes($userData); /*$model->attributes = $params;*/
            if ($user->save() == false) {
                foreach ($user->errors as $error) {
                    throw new \Exception(array_shift($error));
                }
            }
            if (!isset($_COOKIE['ACCESS_TOKEN']) && isset($user->access_token)) {
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'ACCESS_TOKEN',
                    'value' => $user->access_token,
                    'expire' => time() + 114400,
                ]));
            }
            if (!isset($_COOKIE['VISITOR_IDENTITY']) && isset($userData['visitor_identity'])) {
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'VISITOR_IDENTITY',
                    'value' => $userData['visitor_identity'],
                    'expire' => time() + 114400,
                ]));
            }
            return true;
        }
    }
}
