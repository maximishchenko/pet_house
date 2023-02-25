<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FancyboxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/lib/fancybox/fancybox.css',
    ];
    public $js = [
        '/lib/fancybox/fancybox.umd.js',
        // 'js/fancybox.js',
    ];
    public $depends = [
    ];
}
