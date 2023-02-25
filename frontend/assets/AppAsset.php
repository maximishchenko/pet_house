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
        'scss/main.scss',
        // 'css/main.css',
        'css/vendor.css',
    ];
    public $js = [
        'js/src/main.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
        'defer' => 'defer',
        "type" => "module",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
