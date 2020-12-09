<?php
Yii::setAlias('@static', '/');
Yii::setAlias('@admin', '/admin/');
return [
    'siteInfo'       => '管理后台',
    'copyright'      => date('Y') . ' © 管理后台',
    'adminEmail'     => 'admin@example.com',
    'adminIndexUrl'  => '/admin/index.html',
    'adminLoginUrl'  => '/admin/login.html',
    'adminLogoutUrl' => '/admin/logout.html',
    'notFoundUrl'    => '/notfound.html',
    'defaultAvatar'  => '/static/images/default-avatar.jpg',
    'redis'          => [
        'hostname' => 'redis60',
        'port'     => 6379,
        'database' => 0,
        'prefix'   => 'admin:',
        'password' => 'qwe..123',
    ],
    'bottomPageNum'=>5,//底部页码显示数量
    'defaultColumn'=>2,//底部页码显示数量
];
