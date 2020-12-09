<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/23
 * Time: 15:28
 */

namespace app\behaviors;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\base\Behavior;
use yii\web\Request;
use app\modules\admin\service\SysResourcesService;
use app\modules\admin\models\SysActionLog;

class LogactionBehavior extends Behavior
{
    /**
     * 保存注入的 yii\web\Request 实例
     * @var yii\web\Request
     */
    private $request;

    /**
     * 运用传说中的依赖注入 注入 yii\web\Request
     * @param array $config
     * @param yii\web\Request $request
     */
    public function __construct(Request $request, $config = [])
    {
        $this->request = $request;
        parent::__construct($config);
    }

    /**
     * 给事件设置触发函数。
     * 将 beforeAction 函数注册到 Controller::EVENT_BEFORE_ACTION 事件中
     * 将 afterAction 函数注册到 Controller::EVENT_AFTER_ACTION 事件中
     * @return array
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction', Controller::EVENT_AFTER_ACTION => 'afterAction',];
    }

    /**
     * 每次访问时，记录访问的情况到日志里。
     */
    public function beforeAction()
    {
        $noLogUrl = [
            'api/insertdataconfig' => 0,
            'sysactionlog/index'   => 0,
            'sysactionlog/manage'  => 0,
            'actionlog/index'      => 0,
            'index/index'          => 0,
            'default/toolbar'      => 0,
            'user/isoffline'       => 0,
            'user/login'           => 0,
            'user/lockscreen'      => 0,
            'user/logout'          => 0,
        ];
        $action   = yii::$app->controller->id . '/' . yii::$app->controller->action->id;
        if (isset($noLogUrl[$action])) {
            return;
        }
        $description                     = "%s %s。";
        $pagePaths                       = SysResourcesService::getInstance()->getResourcesPathByAction($action);
        Yii::$app->params['breadcrumbs'] = $pagePaths;


        if (isset($pagePaths[0])) {
            $pagePath = "访问了[" . join('-', array_column($pagePaths, 'name')) . "]";
        } else {
            if (empty($this->request->pathInfo)) {
                $pagePath = '登陆了管理后台';
            } else {
                $pagePath = '访问了[' . $action . ']';
            }
        }

        $userinfo    = Yii::$app->session->get('username');
        $userName    = isset($userinfo['displayName']) ? $userinfo['displayName'] : '未知用户'; // Yii::$app->user->identity->username;
        $description = sprintf($description, '', $pagePath);

        $requestData           = $_REQUEST;
        $requestData['method'] = $this->request->getMethod();

        $data  = [
            'action'      => $this->request->pathInfo,
            'description' => $description,
            'user_name'   => $userName,
            'data'        => json_encode($requestData, JSON_UNESCAPED_UNICODE),
            'ip'          => $this->request->userIP,
        ];
        $model = new SysActionLog();
        $model->setAttributes($data);
        if ($model->save() == false) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }

        // Yii::beginProfile('myBenchmark');//开启运行分析，会对数据库查询时间等信息计入日志，myBenchmark 可修改自己设定标识符，会写入日志
    }

    public function afterAction()
    {
        // Yii::endProfile('myBenchmark');//结束运行分析
    }
}
