<?php

namespace frontend\assets;

use yii\web\AssetBundle;

use Yii;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/main.css',
//        'css/site.css',
    ];
    public $js = [
    ];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->js = [
            'js/scripts.js',
            'js/vueapp.js?locale=' . Yii::$app->language,
        ];

        $this->css = [
            'css/main'. (Yii::$app->language == 'he' ? '-rtl' : '') .'.css',
            'css/site.css',
        ];
    }

    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\VendorAsset', //
        //'frontend\assets\ModalAsset',
        'frontend\assets\UIKitAsset',
        'lajax\translatemanager\bundles\TranslationPluginAsset'
    ];
}