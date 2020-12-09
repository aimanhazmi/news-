<?php
/**
 * Created by PhpStorm.
 * User: CLZ
 * Date: 2018/1/15
 * Time: 下午4:42
 */

namespace app\components;

use yii\web\Controller;
class ServiceController extends Controller
{
    protected $serviceManager;
    function init(){
       // $this->serviceManager = new ServiceManager($this->module->getUniqueId());
        parent::init();
    }

    /**
     * Created by CLZ
     * 获取并注册service
     * @param string $serviceName
     * @param array $params
     * @return Service
     */
    public function getService(string $serviceName,$params = []):Service{
        return ServiceManager::getInstance()->getService($serviceName,$params);
    }

    /**
     * Created by CLZ
     * 重新载入service
     * @param string $serviceName
     * @param array $params
     * @return Service
     */
    public function createService(string $serviceName,$params = []):Service{
        return ServiceManager::getInstance()->reloadService($serviceName,$params);
    }
}