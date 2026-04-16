<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\CommonToolkit;
use app\components\RedisToolkit;
use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionSinaip()
    {
        echo CommonToolkit::getLocation('183.193.154.195') . PHP_EOL;
    }

    public function actionRedis()
    {

        // https://www.yiichina.com/tutorial/904
        // https://blog.csdn.net/fei003/article/details/78760029
        /* @var $redis Connection */

        // PHP Redis
        /* @var $redis \Redis(); */
        $redis = RedisToolkit::getInstance();

        // redis list 实现消息队列

        $list_key = 'test:list';

        // 插入列表最后一条消息
        $redis->rPush($list_key, json_encode(['name' => '1']));
        $redis->rPush($list_key, json_encode(['name' => '2']));
        $redis->rPush($list_key, json_encode(['name' => '3']));


        // 获取列表信息
        $data = $redis->lRange($list_key, 0, 100);
        var_export($data);

        // 查询列表长度
        $len = $redis->lLen($list_key);
        echo $len . PHP_EOL;

        // $redis->blPop($list_key, 1); // 移出并获取列表的第一个元素， 如果列表没有元素会阻塞列表直到等待超时或发现可弹出元素为止。
        if ($len > 10) {
            for ($i = 0; $i <= $len; $i++) {
                $redis->lPop($list_key); // 移出并获取列表的第一个元素
            }
        } else {
            $redis->lPop($list_key); // 移出并获取列表的第一个元素
        }

        // 查询列表长度
        echo $redis->lLen($list_key) . PHP_EOL;

        // 获取列表信息
        $data = $redis->lRange($list_key, 0, 100);
        var_export($data);
        exit();

        echo 'ok';
        return;
        // 哈希
        $token = 'test:hash';
        $redis->hMset($token, array('name' => 'lonisy', 'avatar' => 'empty'));

//        var_dump($redis->hGetAll($token)) . PHP_EOL;

        // 有序集合
        // 点赞
        $key = 'test:rank';
        $redis->zAdd($key, 1, "张三", 2, '李四');
        $redis->zAdd($key, 3, "王麻子");
        $redis->zAdd($key, 3, "test");
        $redis->zIncrBy($key, 10, '张三');
        $redis->zRem($key, 'test', 'test2'); // 移除

        var_dump($redis->zRange($key, 0, -1, true)); // 从低到高
        var_dump($redis->zRevRange($key, 0, -1, true)); // 从高到底
        // 获取前五名

    }
}
