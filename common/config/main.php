<?php

use common\models\User;

return [
    'name' => 'Дом питомца',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'configManager',
        'queue',
        'vendor\samdark\SimpleCart',
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru-RU',
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'currencyCode' => 'RUB',
         
         ],
        'configManager' => [
            'class' => 'yii2tech\config\Manager',
            'storage' => [
                'class' => 'yii2tech\config\StoragePhp',
            ],
            'items' => [
                'contactPhone' => [
                    'path' => 'phone',
                    'label' => Yii::t('app', "CONTACT_PHONE"),
                    'description' => Yii::t('app', "CONTACT_PHONE DESCRIPTION"),
                    'value' => "+7 495 088-90-48",
                    'rules' => [
                        ['required']
                    ],
                    'inputOptions' => [
                        'type' => 'phone',
                    ],
                ],
                'contactEmail' => [
                    'path' => 'email',
                    'label' => Yii::t('app', "CONTACT_EMAIL"),
                    'description' => Yii::t('app', "CONTACT_EMAIL DESCRIPTION"),
                    'value' => "info@domgryzunov.ru",
                    'rules' => [
                        ['required'],
                        ['email']
                    ],
                ],
                'contactWhatsapp' => [
                    'path' => 'whatsapp',
                    'label' => Yii::t('app', "CONTACT_WHATSAPP"),
                    'description' => Yii::t('app', "CONTACT_WHATSAPP DESCRIPTION"),
                    'value' => "https://wa.me/79268181180",
                    'rules' => [
                        ['required'],
                        ['url'],
                    ],
                ],
                'contactTelegram' => [
                    'path' => 'telegram',
                    'label' => Yii::t('app', "CONTACT_TELEGRAM"),
                    'description' => Yii::t('app', "CONTACT_TELEGRAM DESCRIPTION"),
                    'value' => "tg://resolve?domain=esc00000",
                    'rules' => [
                        ['required'],
                    ],
                ],
                'contactVk' => [
                    'path' => 'vk',
                    'label' => Yii::t('app', "CONTACT_VK"),
                    'description' => Yii::t('app', "CONTACT_VK DESCRIPTION"),
                    'value' => "https://vk.com/domgryzunov",
                    'rules' => [
                        ['required'],
                        ['url'],
                    ],
                ],
                'contactWhatsapp' => [
                    'path' => 'whatsapp',
                    'label' => Yii::t('app', "CONTACT_WHATSAPP"),
                    'description' => Yii::t('app', "CONTACT_WHATSAPP DESCRIPTION"),
                    'value' => "https://wa.me/+79282662615",
                    'rules' => [
                        ['required'],
                        ['url'],
                    ],
                ],
                'contactInstagram' => [
                    'path' => 'instagram',
                    'label' => Yii::t('app', "CONTACT_INSTAGRAM"),
                    'description' => Yii::t('app', "CONTACT_INSTAGRAM DESCRIPTION"),
                    'value' => "https://instagram.com/domgryzunov?igshid=YmMyMTA2M2Y=",
                    'rules' => [
                        ['url'],
                    ],
                ],
                'contactAvito' => [
                    'path' => 'avito',
                    'label' => Yii::t('app', "CONTACT_AVITO"),
                    'description' => Yii::t('app', "CONTACT_AVITO DESCRIPTION"),
                    'value' => "https://www.avito.ru/user/9c46c8e3be3dbd358be90a4e7cfdbb9e/profile",
                    'rules' => [
                        ['url'],
                    ],
                ],
                'contactLiveMaster' => [
                    'path' => 'livemaster',
                    'label' => Yii::t('app', "CONTACT_LIVEMASTER"),
                    'description' => Yii::t('app', "CONTACT_LIVEMASTER DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                        ['url'],
                    ],
                ],
                'contactOzon' => [
                    'path' => 'ozon',
                    'label' => Yii::t('app', "CONTACT_OZON"),
                    'description' => Yii::t('app', "CONTACT_OZON DESCRIPTION"),
                    'value' => "https://www.ozon.ru/brand/dom-gryzunov-100373934/",
                    'rules' => [
                        ['url'],
                    ],
                ],
                'contactMapLink' => [
                    'path' => 'mapLink',
                    'label' => Yii::t('app', "MAP_LINK"),
                    'description' => Yii::t('app', "MAP_LINK DESCRIPTION"),
                    'value' => "https://yandex.ru/maps/1/moscow-and-moscow-oblast/house/burovaya_ulitsa_2a/Z04YdgFoQEUPQFtsfXx3eHhjYA==/?ll=37.068908%2C56.069404&z=17",
                    'rules' => [
                        ['url'],
                    ],
                ],
                'contactAddress' => [
                    'path' => 'address',
                    'label' => Yii::t('app', "ADDRESS"),
                    'description' => Yii::t('app', "ADDRESS DESCRIPTION"),
                    'value' => "Московская область, Солнечногорский район, пос. Поварово, ул. Буровая, 2А",
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'textarea',
                    ],
                ],
                'contactRequisites' => [
                    'path' => 'requisites',
                    'label' => Yii::t('app', "REQUISITES"),
                    'description' => Yii::t('app', "REQUISITES DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'textarea',
                    ],
                ],
                'companyStartYear' => [
                    'path' => 'company_start_year',
                    'label' => Yii::t('app', "COMANY START YEAR"),
                    'description' => Yii::t('app', "COMANY START YEAR DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'integer',
                    ],
                ],
                'seoDefaultKeywords' => [
                    'path' => 'seo_keywords',
                    'label' => Yii::t('app', "SEO_KEYWORDS"),
                    'description' => Yii::t('app', "SEO_KEYWORDS DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'seoDefaultDescription' => [
                    'path' => 'seo_description',
                    'label' => Yii::t('app', "SEO_DESCRIPTION"),
                    'description' => Yii::t('app', "SEO_DESCRIPTION DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'textarea',
                    ],
                ],
            ],
        ],
        'telegram' => [
            'class' => 'aki\telegram\Telegram',
            'botToken' => '',
        ],
        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'path' => '@console/runtime/queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
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
