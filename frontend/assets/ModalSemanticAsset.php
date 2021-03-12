<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ModalSemanticAsset extends AssetBundle
{
    public $sourcePath = '@bower/semantic';

    public $css = [
        'dist/components/transition.css',
        'dist/components/dimmer.css',
        'dist/components/button.css',
        'dist/components/modal.css'
    ];

    public $js = [
        'dist/components/transition.js',
        'dist/components/dimmer.js',
        'dist/components/modal.js'
    ];
}