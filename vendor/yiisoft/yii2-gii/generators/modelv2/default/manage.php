<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/21
 * Time: 18:59
 */

$tpl = file_get_contents(__DIR__ . "/tpl/manage.tpl.php");
$tpl = str_replace("__MODEL_CLASS__", $generator->modelClass, $tpl);
$tpl = str_replace("__CONTROLLER_NAME__", strtolower($generator->controllerClass), $tpl);
echo $tpl;