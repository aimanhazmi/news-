<?php

return [
    'class'               => 'yii\db\Connection',
    'dsn'                 => 'mysql:host=' . (getenv('PROD_DB_HOST') ?: 'mysql80con') . ';port=' . (getenv('PROD_DB_PORT') ?: 3306) . ';dbname=' . (getenv('PROD_DB_NAME') ?: 'yii_news'),
    'username'            => getenv('PROD_DB_USERNAME') ?: 'root',
    'password'            => getenv('PROD_DB_PASSWORD') ?: '',
    'charset'             => 'utf8mb4',
    'enableSchemaCache'   => true,
    'schemaCacheDuration' => 60,
    'schemaCache'         => 'cache',
];
