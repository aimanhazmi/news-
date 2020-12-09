<?php
//$db['dsn'] = 'mysql:host=localhost;dbname=yii2_basic_tests';
return [
    'class'               => 'yii\db\Connection',
    'dsn'                 => 'mysql:host=mysql80con;dbname=news',
    'username'            => 'admin',
    'password'            => 'qwe..123',
    'charset'             => 'utf8',
    'enableSchemaCache'   => true,
    'schemaCacheDuration' => 60,
    'schemaCache'         => 'cache',
];
