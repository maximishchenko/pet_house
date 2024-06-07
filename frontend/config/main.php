<?php

use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\widgets\ActiveFormAsset;

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
        'seo' => [
            'class' => 'frontend\modules\seo\Module',
        ],
    ],   
    // 'on beforeRequest' => function () {
    //     if (time() > 1716584400) {
    //         Yii::$app->catchAll = [
    //           's', 
    //           'name' => "",
    //           'message' => ""
    //         ];
    //     }
    // },
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
            'bundles' => [

                JqueryAsset::class => false,
                YiiAsset::class => false,
                ActiveFormAsset::class => false,
            ],
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
                [
                    'pattern' => 'sitemap', 
                    'route' => 'seo/sitemap/index', 
                    'suffix' => '.xml'
                ], 

                'catalog/default/get-reviews' => 'catalog/default/get-reviews',

                'cart' => 'cart/default/index',
                'cart/add-to-cart' => 'cart/default/add-to-cart',
                'cart/clear-cart' => 'cart/default/clear-cart',
                'cart/get-total-count' => 'cart/default/get-total-count',
                'cart/delete-item' => 'cart/default/delete-item',
                'cart/update-product-count' => 'cart/default/update-product-count',

                'catalog/default/calculate-price-constructor' => 'catalog/default/calculate-price-constructor',
                'chinchilles' => 'catalog/default/index',
                'chinchilles/<slug>' => 'catalog/default/view',

                'dogs' => 'catalog/default/index',
                'dogs/<slug>' => 'catalog/default/view',

                'catalog/<catalog_slug>' => 'catalog/default/index',
                'catalog/<catalog_slug>/<item_slug>' => 'catalog/default/view',
                'privacy' => 'site/privacy',
                'delivery' => 'site/delivery',
                'page-not-found' => 'site/page-not-found',


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
