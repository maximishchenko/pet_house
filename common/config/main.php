<?php

use common\models\User;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => YII_ENV_PROD ? 'yii\caching\FileCache' : 'yii\caching\DummyCache',
        ],
        'db' => [
            'enableSchemaCache' => YII_ENV_PROD ? true : false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => array_keys(User::getRolesArray()),
        ],
    ],
];
