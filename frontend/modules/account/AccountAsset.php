<?php

namespace account;

use yii\web\AssetBundle;

class AccountAsset extends AssetBundle
{
    public $sourcePath = '@account/assets';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $css = [

    ];
    public $js = [
        'js/account.js'
    ];

    public $depends = [
        'frontend\assets\VendorAsset',
    ];
}