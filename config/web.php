<?php

use app\components\helpers\ConfigHelper;
use app\components\LanguageSelector;
use app\models\User;
use codemix\localeurls\UrlManager;
use yii\bootstrap4\BootstrapAsset;
use yii\caching\FileCache;
use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;

require_once __DIR__ . '/../components/helpers/ConfigHelper.php';

ConfigHelper::load();

$params = require __DIR__ . '/params.php';

require_once __DIR__ . '/functions.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => [
        'log',
        [
            'class' => LanguageSelector::class,
            'supportedLanguages' => ['ru-RU', 'kk-KZ', 'en-US'],
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@dist' => '@app/web/dist',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY'],
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => UrlManager::class,
            'languages' => ['ru', 'kk', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'cache' => false,
            'rules' => [],
        ],
        'db' => ConfigHelper::createDbConfig('broker'),
        'assetManager' => [
            'forceCopy' => YII_ENV_DEV,
            'bundles' => [
                BootstrapAsset::class => [
                    // Не импортим стили т.к. используем свой скомпилированный файл
                    'css' => [],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => DebugModule::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => GiiModule::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
