<?php

use backend\modules\management\models\Setting;

return [
    1 => [
        'name' => 'Телефон',
        'key' => 'phone',
        'value' => '+7 123 456-78-90',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],   
    2 => [
        'name' => 'Email',
        'key' => 'email',
        'value' => 'info@example.com',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],  
    3 => [
        'name' => 'Instagram',
        'key' => 'instagram',
        'value' => 'https://instagram.com/example',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],   
    4 => [
        'name' => 'WhatsApp',
        'key' => 'whatsapp',
        'value' => 'https://wa.me/+71234567890',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],    
    5 => [
        'name' => 'Telegram',
        'key' => 'telegram',
        'value' => 'tg://resolve?domain=example',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],   
    6 => [
        'name' => 'Вконтакте',
        'key' => 'vk',
        'value' => 'https://vk.com/example',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],  
    7 => [
        'name' => 'Ссылка на карту',
        'key' => 'map',
        'value' => 'https://yandex.ru/maps/1/moscow-and-moscow-oblast/house/burovaya_ulitsa_2a/Z04YdgFoQEUPQFtsfXx3eHhjYA==/?ll=37.068908%2C56.069404&z=17',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],
    8 => [
        'name' => 'Адрес',
        'key' => 'address',
        'value' => 'Московская область, Солнечногорский район, пос. Поварово, ул. Буровая, 2А',
        'field_type' => Setting::FIELD_TYPE_TEXT,
        'tab' => Setting::TAB_CONTACT,
    ],
    9 => [
        'name' => 'Координаты',
        'key' => 'coordinates',
        'value' => '37.068908,56.069404',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_CONTACT,
    ],
    10 => [
        'name' => 'Значение keywords по-умолчанию',
        'key' => 'keywords',
        'value' => 'default keywords value',
        'field_type' => Setting::FIELD_TYPE_STR,
        'tab' => Setting::TAB_SEO,
    ],
    11 => [
        'name' => 'Значение description по-умолчанию',
        'key' => 'description',
        'value' => 'default description value',
        'field_type' => Setting::FIELD_TYPE_TEXT,
        'tab' => Setting::TAB_SEO,
    ],
];