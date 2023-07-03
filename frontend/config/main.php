<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'домпитомца.рф',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'catalog' => [
            'class' => 'frontend\modules\catalog\Module',
        ],
        'cart' => [
            'class' => 'frontend\modules\cart\Module',
        ],
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
                'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
            ],
        ], 
        'urlManager' => [
            'on languageChanged' => 'common\components\SwitchLanguage::onLanguageChanged',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'catalog/default/calculate-price-constructor' => 'catalog/default/calculate-price-constructor',
                'chinchilles' => 'catalog/default/index',
                'chinchilles/<slug>' => 'catalog/default/view',
                'catalog/<catalog_slug>' => 'catalog/default/index',
                'catalog/<catalog_slug>/<item_slug>' => 'catalog/default/view',
                'privacy' => 'site/privacy',
                'delivery' => 'site/delivery',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                '<module>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
