<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/1/15
 * Time: 上午11:53
 */

namespace app\components;

use Yii;
use yii\base\Component;

class ServiceManager extends Component
{
    private static $instance = null;
    private $_serviceList = [];


    public function init()
    {
        if (YII_DEBUG) {
            Yii::info("ServiceManager初始化");
        }
    }

    /**
     * Created by aiman
     * @return ServiceManager
     */

    public static function getInstance(): ServiceManager
    {
        if (is_null(static::$instance)) {
            if (YII_DEBUG) {
                Yii::info("ServiceManager初始化");
            }
            static::$instance = new ServiceManager();
            return static::$instance;
        } else {
            return static::$instance;
        }
    }

    /**
     * Created by aiman
     * @param string $serviceName
     * @param array $params
     * @return mixed
     */
    public function getService(string $serviceName, $params = [])
    {
        $tmpParams = $this->transServiceName($serviceName);
        if (YII_DEBUG) {
            Yii::info("SERVICEINFO:getService:根据serviceName:" . $serviceName . ":获取service参数:" . var_export($tmpParams, true));
        }
//        var_dump($tmpParams);exit;
        if (isset($this->_serviceList[$tmpParams["serviceKey"]])) {
            return $this->_serviceList[$tmpParams["serviceKey"]];
        } else {
            $this->_serviceList[$tmpParams["serviceKey"]] = new Service($tmpParams["className"], $tmpParams["version"], $tmpParams["baseModule"], $params);
            return $this->_serviceList[$tmpParams["serviceKey"]];
        }
    }

    /**
     * Created by aiman
     * @param string $serviceName
     * {
     *      //默认使用根目录下的service   "order",
     *      //使用module下的公用service   "app:Order"
     *      //使用对应module下对应版本的service  "app:v1:Order"
     *
     * }
     * @return array
     */
    private function transServiceName(string $serviceName)
    {
        $tmpArray = explode(":", $serviceName);
        $count = count($tmpArray);
        if ($count == 1) {
            //默认使用根目录下的service   "order"
            $className = str_replace("Service", "", trim($serviceName)) . 'Service';
            $serviceKey = 'base:' . $className;
            $baseModule = '';
            $version = Service::TYPE_PUBLIC_SERVICE;
        } else if ($count == 2) {
            if ($tmpArray[0] == 'base') {
                //使用module下的公用service   "app:order"
                $className = str_replace("Service", "", trim($tmpArray[1])) . 'Service';
                $baseModule = "";
                $version = Service::TYPE_PUBLIC_SERVICE;
                $serviceKey = "base:" . $className;
            } else {
                //使用module下的公用service   "app:order"
                $className = str_replace("Service", "", trim($tmpArray[1])) . 'Service';
                $baseModule = $tmpArray[0];
                $version = Service::TYPE_MODULE_PUBLIC_SERVICE;
                $serviceKey = $baseModule . ":base:" . $className;
            }
        } else {
            //使用对应module下对应版本的service  "app:v1:order"
            $className = str_replace("Service", "", trim($tmpArray[2])) . 'Service';
            $baseModule = $tmpArray[0];
            $version = $tmpArray[1];
            $serviceKey = $baseModule . ":" . $version . ":" . $className;
        }
        return [
            "serviceKey" => $serviceKey,
            "className" => str_replace(".", "\\", $className),
            "baseModule" => $baseModule,
            "version" => $version,
        ];
    }

    /**
     * Created by aiman
     * 重新载入service
     * @param string $serviceName
     * @param array $params
     * @return mixed
     */
    public function reloadService(string $serviceName, $params = [])
    {
        $tmpParams = $this->transServiceName($serviceName);
        if (YII_DEBUG) {
            Yii::info("SERVICEINFO:reloadService:根据serviceName:" . $serviceName . ":获取service参数:" . var_export($tmpParams, true));
        }
        $this->_serviceList[$tmpParams["serviceKey"]] = new Service($tmpParams["className"], $tmpParams["version"], $tmpParams["baseModule"], $params);
        return $this->_serviceList[$tmpParams["serviceKey"]];
    }
}
