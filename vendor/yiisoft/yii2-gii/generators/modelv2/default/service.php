<?php
$tpl = file_get_contents(__DIR__ . "/tpl/service.tpl.php");

$model_class = ucwords($generator->modelClass);

$class_name  = "{$generator->serviceClass}Service";
$use_parent_class = !empty($generator->parentServiceClass)?$generator->parentServiceClass:$class_name;

if (class_exists("app\\service\\$use_parent_class", true)) {
    $use_parent_class = 'use app\service\\'.$use_parent_class.' as OriginalService;';
    $class_name       = $class_name . ' extends OriginalService';
}else{
    $use_parent_class = '';
}

$tpl = str_replace("use __USE_PARENT_CLASS__;", $use_parent_class, $tpl);
$tpl = str_replace("__CLASS_NAME__", $class_name, $tpl);
$tpl = str_replace("__MODEL_CLASS__", $model_class, $tpl);
echo $tpl;
