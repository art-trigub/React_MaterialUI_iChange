<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/modal.css'
    ];

    public $js = [
        'js/modal.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'frontend\assets\JqueryTmplAsset',
        'frontend\assets\ModalSemanticAsset',
        'lajax\translatemanager\bundles\TranslationPluginAsset'
    ];
}