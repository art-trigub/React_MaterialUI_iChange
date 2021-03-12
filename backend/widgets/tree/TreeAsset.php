<?php


namespace backend\widgets\tree;

use yii\web\AssetBundle;


class TreeAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/tree/assets';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $js = [
        'tree.js'
    ];

    public $css = [
        'tree.css'
    ];

    public $depends = [
        'backend\assets\MetronicAsset',
    ];

}
