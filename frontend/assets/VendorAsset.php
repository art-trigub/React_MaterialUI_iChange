<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;
/**
 * Main frontend application asset bundle.
 */
class VendorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $js = [
        'js/vendor.js',
        'js/commons.js',
    ];

    public $depends = [
        'lajax\translatemanager\bundles\TranslationPluginAsset'
    ];
}
