<?php
$params = require __DIR__ . '/' . YII_ENV . '/params.php';
$db     = require __DIR__ . '/' . YII_ENV . '/db.php';
$redis  = require __DIR__ . '/' . YII_ENV . '/redis.php';

$config           = [
    'id'           => 'lilei.admin',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'charset'      => 'utf-8',
    'language'     => 'zh-CN',
    'timeZone'     => 'Asia/Shanghai',
    'aliases'      => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules'      => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'front' => [
            'class' => 'app\modules\front\Module',
        ],
    ],
    'components'   => [
        'request'      => [
            'enableCookieValidation' => false,
            'cookieValidationKey'    => '9pTfOv50SaWJqqNaQQZQcpEAAF6nrc1S',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'FileService'  => [
            'class'        => 'app\service\FileService',
            //            'uploadDir'    => 'runtime/upload',
            'uploadDir'    => 'web/uploads',
            'rsyncCommand' => 'rsync -rRtapW --delete --timeout=30',
            'rsyncServer'  => '',
            'rsyncModule'  => '/data/web/test/web/uploads',
            'rsyncStatus'  => 'off',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [
                        'info',
                        'error',
                        'warning'
                    ],
                ],
            ],
        ],
        'db'           => $db,
        'redis'        => $redis,
        'session'      => [
            'class' => 'yii\redis\Session',
            'redis' => 'redis',
        ],
        'defaultRoute' => 'index/index',
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                ''                                                 => 'front/main/index',
                'index'                                            => 'front/main/index',
                'category.html'                                    => 'front/category/index',
                'categorylist.html'                                => 'front/category/categorylist',
                'search.html'                                      => 'front/article/search',
                'tag.html'                                      => 'front/article/tag',
                'news-<id:\d+>.html'                               => 'front/article/news',
                'news.html'                                        => 'front/article/news',
                'article-<id:\d+>.html'                            => 'front/article/index',
                'category-<id:\d+>.html'                           => 'front/category/index',
                'categorylist-<id:\d+>.html'                       => 'front/category/categorylist',
                'contact.html'                                     => 'front/article/contact',
                'about.html'                                       => 'front/article/about',
                'guestbook.html'                                   => 'front/main/guestbook',
                'notfound.html'                                    => 'front/main/notfound',
                'admin/index.html'                                 => 'admin/index/index',
                'admin/login.html'                                 => 'admin/user/login',
                'admin/logout.html'                                => 'admin/user/logout',
                'admin/<controller:\w+>/<id:\d+>'                  => 'admin/<controller>/index',
                '<controller:\w+>/<id:\d+>'                        => '<controller>/index',
                '<controller:\w+>/<action:\w+>.html'               => '<controller>/<action>',
                '<modules:\w+>/<controller:\w+>/<action:\w+>.html' => '<modules>/<controller>/<action>',
            ],
        ],
    ],
    'params'       => require __DIR__ . '/params.php',
    'as ActionLog' => 'app\\behaviors\\ActionLogBehavior',
    'as Logaction' => 'app\\behaviors\\LogactionBehavior',
];
$config['params'] = array_merge($params, $config['params']);

if (YII_ENV_DEV && YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [
            '*',
            '::1'
        ],

    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [
            '127.0.0.1',
            '::1',
            '*'
        ],
    ];
}

return $config;
