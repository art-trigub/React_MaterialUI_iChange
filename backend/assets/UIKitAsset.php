<?php

namespace backend\assets;


use yii\web\AssetBundle;

class UIKitAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/uikit.min.js'
    ];
}