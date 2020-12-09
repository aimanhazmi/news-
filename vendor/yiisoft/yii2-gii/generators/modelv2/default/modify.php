<?php
/**
 * Created by PhpStorm.
 * User: CLZ
 * Date: 2018/1/18
 * Time: 下午9:32
 */
$tpl = file_get_contents(__DIR__ . "/tpl/modify.tpl.php");
$tpl = str_replace("__CONTROLLER_NAME__", strtolower($generator->controllerClass), $tpl);
echo $tpl;
?>