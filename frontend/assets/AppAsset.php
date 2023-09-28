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
        'js/lib/jquery-3.6.0.min.js',
        'js/vendor/masonry.pkgd.min.js',
        'assets/build/js/main.js',
        // 'js/components/constructor.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
        'defer' => 'defer',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
    ];
}
