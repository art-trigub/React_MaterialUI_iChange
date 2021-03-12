<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryTmplAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-tmpl';

    public $js = [
        'jquery.tmpl.min.js'
    ];

    public $depends = [

    ];

}


?>