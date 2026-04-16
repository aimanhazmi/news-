<?php
Yii::setAlias('@static', '/');
Yii::setAlias('@admin', '/admin/');
return [
    'siteInfo'       => '管理后台',
    'copyright'      => date('Y') . ' © 管理后台',
    'adminEmail'     => getenv('ADMIN_EMAIL') ?: 'ammzz2020@gmail.com',
    'adminIndexUrl'  => '/admin/index.html',
    'adminLoginUrl'  => '/admin/login.html',
    'adminLogoutUrl' => '/admin/logout.html',
    'notFoundUrl'    => '/notfound.html',
    'defaultAvatar'  => '/static/images/default-avatar.jpg',
    'redis'          => [
        'hostname' => getenv('REDIS_HOST') ?: 'redis60',
        'port'     => (int)(getenv('REDIS_PORT') ?: 6379),
        'database' => (int)(getenv('REDIS_DB') ?: 0),
        'prefix'   => getenv('REDIS_PREFIX') ?: 'admin:',
        // Leave empty by default; set via environment
        'password' => getenv('REDIS_PASSWORD') ?: '',
    ],
    'bottomPageNum'=>5,//底部页码显示数量
    'defaultColumn'=>2,//底部页码显示数量
];
