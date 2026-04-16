<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/1/15
 * Time: 上午11:02
 */

namespace app\components;
use Yii;
class Service
{
    const TYPE_PUBLIC_SERVICE = "public"; //使用根目录下的公用service
    const TYPE_MODULE_PUBLIC_SERVICE = "module_public"; //使用当前module下的公用service
    private $_baseClass = "app\\service\\";
    private $_baseService = null;
    private $_baseServiceReflect = null;

    function __construct(string $className,string $version = Service::TYPE_PUBLIC_SERVICE ,string $moduleName = "app",$params = [])
    {
        switch($version){
            case Service::TYPE_PUBLIC_SERVICE:
                $this->_baseClass = "app\\service\\".$className;
                break;
            case Service::TYPE_MODULE_PUBLIC_SERVICE:
                $this->_baseClass = "app\\modules\\".$moduleName."\\service\\".$className;
                break;
            default:
                $this->_baseClass = "app\\modules\\".$moduleName."\\service\\".$version."\\".$className;
                break;
        }
        if(YII_DEBUG) {
            Yii::info("SERVICEINFO:注册service:".$this->_baseClass.":初始化参数:".var_export($params,true));
        }
        if(class_exists($this->_baseClass)){
            $this->_baseServiceReflect = new \ReflectionClass($this->_baseClass);
            if(is_array($params)){
                $this->_baseService = $this->_baseServiceReflect->newInstanceArgs($params);
            }else{
                $this->_baseService = new $this->_baseClass;
            }
        }else{
            throw new \Exception("找不到指定服务:".$this->_baseClass);
        }
    }

    function __call($name, $arguments)
    {
        //判断当前注册的模块下service是否存在并且判断指定的方法是否存在
        if(!empty($this->_baseService)&&$this->_baseServiceReflect->hasMethod($name)){
            if ($this->_baseServiceReflect->getMethod($name)->isStatic()){
                if(YII_DEBUG) {
                    Yii::info("SERVICEINFO:调用service:".$this->_baseClass."::".$name."():参数:".var_export($arguments,true));
                }
                return call_user_func_array(array($this->_baseServiceReflect->getName(), $name), $arguments);
            }else{
                if(YII_DEBUG) {
                    Yii::info("SERVICEINFO:调用service:".$this->_baseClass."->".$name."():参数:".var_export($arguments,true));
                }
                return call_user_func_array(array($this->_baseService, $name), $arguments);
            }
        }else{
            throw new \Exception("service未找到指定的方法");
        }
    }

}