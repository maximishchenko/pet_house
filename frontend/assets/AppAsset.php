<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'scss/vendor.scss',
        // 'scss/main.scss',
        'css/vendor.css',
        'css/main.css',
    ];
    public $js = [
        // 'js/src/main.js',
        'js/main.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
        // 'defer' => 'defer',
        "type" => "module",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
