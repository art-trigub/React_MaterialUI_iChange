<?php

namespace backend\assets;

use yii\web\AssetBundle;

class GlyphiconsBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/glyphicons-only-bootstrap';

    public $css = [
        'css/bootstrap.css'
    ];
}