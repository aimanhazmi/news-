<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/12/30
 * Time: 12:25
 */


namespace app\behaviors;

use app\modules\admin\service\SysResourcesService;
use app\modules\admin\models\SysActionLog;
use Yii;
use yii\base\Application;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Url;


class ActionLogBehavior extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'handle',
        ];
    }

    public function handle()
    {
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_UPDATE, [$this, 'log']);
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT, [$this, 'log']);
        Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_DELETE, [$this, 'log']);
    }

    public function log($event)
    {
        if ($event->sender instanceof SysActionLog || !$event->sender->primaryKey()) {
            return;
        }
        if ($event->name == ActiveRecord::EVENT_AFTER_INSERT) {
            $description = "%s %s 新增了 %s 表 %s 的一条记录。";
        } else if ($event->name == ActiveRecord::EVENT_AFTER_UPDATE) {
            $description = "%s %s 修改了 %s 表 %s 的一条记录。";
        } else {
            $description = "%s %s 删除了 %s 表 %s 的一条记录。";
        }

        $pathinfo  = yii::$app->controller->id . '/' . yii::$app->controller->action->id;
        $pagePaths = isset(Yii::$app->params['breadcrumbs']) ? Yii::$app->params['breadcrumbs'] : SysResourcesService::getInstance()->getResourcesPathByAction($pathinfo);

        $pagePath = '访问了[未定义的菜单 ' . $pathinfo . '];';
        if (isset($pagePaths[0])) {
            $pagePath = "访问了[" . join('-', array_column($pagePaths, 'name')) . "];";
        }
        $attributes = [];
        if (!empty($event->changedAttributes)) {
            foreach ($event->changedAttributes as $name => $value) {
                $attributes[$name] = $event->sender->getAttribute($name);
            }
        }

        $userinfo    = Yii::$app->session->get('username');
        $userName    = isset($userinfo['displayName']) ? $userinfo['displayName'] : '未知用户'; // Yii::$app->user->identity->username;
        $primaryKey  = $event->sender->primaryKey()[0];
        $primaryVal  = is_array($event->sender->getPrimaryKey()) ? current($event->sender->getPrimaryKey()) : $event->sender->getPrimaryKey();
        $tableName   = $event->sender->tableSchema->name;
        $description = sprintf($description, '', $pagePath, $tableName, $primaryKey . "=" . $primaryVal);
        $route       = Url::to();
        $ip          = Yii::$app->request->userIP;

        $data  = [
            'action'      => $route,
            'description' => $description,
            'user_name'   => $userName,
            'data'        => json_encode($attributes, JSON_UNESCAPED_UNICODE),
            'ip'          => $ip,
        ];
        $model = new SysActionLog();
        $model->setAttributes($data);
        if ($model->save() == false) {
            foreach ($model->errors as $error) {
                throw new \Exception(array_shift($error));
            }
        }
    }
}