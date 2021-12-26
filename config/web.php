<?php

use app\models\auth\User;
use kartik\grid\Module as GridModule;
use mdm\admin\controllers\AssignmentController;
use mdm\admin\components\AccessControl;
use yii\rbac\DbManager;
use mdm\admin\Module as AdminModule;
use app\components\helpers\ConfigHelper;
use app\components\LanguageSelector;
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
    'name' => 'Универсистет Туран-Астана',
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
    'modules' => [
        'admin' => [
            'class' => AdminModule::class,
            'controllerMap' => [
                'assignment' => [
                    'class' => AssignmentController::class,
                    'userClassName' => User::class,
                    'usernameField' => 'email',
                ],
            ],
        ],
        'gridview' => [
            'class' => GridModule::class,
        ],
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
            'loginUrl' => ['admin/user/login'],
        ],
        'authManager' => [
            'class' => DbManager::class,
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
    'as access' => [
        'class' => AccessControl::class,
        'allowActions' => [
            'site/*',
            'admin/*',
            'gii/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
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
