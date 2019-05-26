<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'en',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@img' => '@app/web/img/',
    ],
    'components' => [
//        Активировать роли RBAC, так же нужно сделать в консоли
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => "@app/messages"
                ],
                'view*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => "@app/messages"
                ],
            ]
        ],
        'bootstrap' => [
            'class' => \app\components\Bootstrap::class
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'o70eH_h6H29D73PeQSNLuFbtUQZ9TzWi',
        ],
        'cache' => [
//            'class' => 'yii\caching\FileCache',
            'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'user' => [
            'identityClass' => \app\models\UserIdentity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        //URL-менеджер, вместо site?r=controller/action/... используется: site/controller/action/id...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'enableStrictParsing' => true,
            'rules' => [
                'task/<page>/<per-page>' => 'task/index',
                'tasks' => 'task/index',
//                'task/<id>' => 'task/one',
                'GET task/<id>' => 'task/one',
//                'POST task/<id>' => 'task/two'
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
