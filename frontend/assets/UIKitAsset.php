<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;


/**
 * Main frontend application asset bundle.
 */
class UIKitAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';

    public $sourcePath = '@bower/uikit';

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    public $css = [
        //'css/uikit.css'
    ];

    public $js = [
        'dist/js/uikit.min.js',
        //'js/uikit-icons.min.js'
    ];

}
