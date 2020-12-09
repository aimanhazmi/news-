<?php
$tpl = file_get_contents(__DIR__ . "/tpl/controller.tpl.php");
$tpl = str_replace("__MODEL_CLASS__", ucwords($generator->modelClass), $tpl);
$tpl = str_replace("__CONTROLLER_NAME__", ucwords(strtolower($generator->controllerClass)), $tpl);
echo $tpl;