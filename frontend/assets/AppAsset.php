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
        'assets/build/css/vendor.css',
        'assets/build/css/main.css',
    ];
    public $js = [
        'js/lib/js.cookie.min.js',
         'assets/build/js/main.js',
        'js/components/cookie.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
        'defer' => 'defer',
    ];
    public $depends = [];
}
