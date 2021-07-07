<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
        'modules' => [
                'user-module' => [
                        'class' => 'app\modules\UserModule\UserModule',
                ],
                'bearer-api' => [
                        'class' => 'app\modules\BearerApi\BearerApi',

                ],
        ],
    'components' => [
            'queue' => [
                    'class' => \yii\queue\file\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            // Other driver options
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5dN7BrMjnZRj5iPtyVGBRcx-iJwAyCj6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
            'authManager' => [
                    'class' => 'yii\rbac\PhpManager',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              /*      'store/upload'=>'store/upload',
                    'stores'=>'store/index',
                    'comment/send'=>'comment/send',*/
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Api',  'prefix' => 'api'],
                    'api/<id:\d+>'=>'api/view',
                    [
                            'pattern' => 'users',
                            'route' => 'users/index',
                            'suffix' => '/',
                            'normalizer' => false, // отключаем нормализатор для этого правила
                    ],
                    '<controller:\w+>'=>'<controller>/index',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action>'=>'<controller>/<action>',
                    '<module:\w+>' => '<module>/default/index',
                    '<module:\w+>/<id:\d+>' => '<module>/default/view',
                    '<module:\w+>/edit/<id:\d+>' => '<module>/default/edit',
                    '<module:\w+>/delete/<id:\d+>' => '<module>/default/delete',
                    '<module:[\w\-]+>/<action:[\w\-]+>' => '<module>/default/<action>',
                    '<module:[\w\-]+>/<controller:\w+>' => '<module>/<controller>/index',
                    '<module:[\w\-]+>/<controller:\w+>/edit/<id:\d+>' => '<module>/<controller>/edit',
                    '<module:[\w\-]+>/<controller:\w+>/delete/<id:\d+>' => '<module>/<controller>/delete',
                    '<module:[\w\-]+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                    '<module:[\w\-]+>/<controller:\w+>/<action>' => '<module>/<controller>/<action>',
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
