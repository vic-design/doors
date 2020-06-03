<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'name' => 'РД-ТРЕЙДИНГ',
    'bootstrap' => [
        'log',
        'app\bootstrap\SetUp',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'mainadmin' => [
            'class' => 'app\modules\mainadmin\Module',
            'layout' => 'main',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'roots' => [
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'files/editor',
                    'name' => 'Global'
                ],
            ],
            'plugin' => [
                [
                    'class' => '\mihaildev\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
            ],
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'T-dD_dHVz5tUR-eEZGhOgjbCFipQOWlT',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],
        'user' => [
            'identityClass' => 'app\fond\entities\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => FALSE,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.timeweb.ru',
                'username' => 'info@abutan.tmweb.ru',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig' => [
                'from' => ['info@abutan.tmweb.ru' => 'РД Трейдинг'],
            ],
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
            'cache' => false,
            'rules' => [
                'mainadmin' => 'mainadmin/default/index',
                'novosti-i-akcii' => 'stock/page',
                'catalog' => 'shop/catalog/index',
                '<slug:[\w\-_]+>' => 'shop/catalog/product',
                'info/<slug:[\w\-_]+>' => 'article/node',
                'novosti-i-akcii/<slug:[\w\-_]+>' => 'stock/node',
                'category/<slug:[\w\-_]+>' => 'shop/catalog/category'
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
