<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . (getenv('DB_HOST') ?: 'mysql') . ';port=' . (getenv('DB_PORT') ?: 3306) . ';dbname=' . (getenv('DB_NAME') ?: 'news_db'),
    'username' => getenv('DB_USERNAME') ?: 'news',
    'password' => getenv('DB_PASSWORD') ?: '',
    'charset' => 'utf8',
];
