<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/backend.css',
        'css/fancybox.css',
        'css/jquery-ui.css',
        'css/sortable.css',
        'css/checkbox.css',
        '/lib/fancybox/fancybox.css',
    ];
    public $js = [
        'js/jquery-ui.js',
        '/lib/fancybox/fancybox.umd.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
