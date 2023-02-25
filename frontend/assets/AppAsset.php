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
        'css/main.css',
        'css/vendor.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
        'defer' => 'defer',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
