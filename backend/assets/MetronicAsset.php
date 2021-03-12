<?php

namespace backend\assets;

use yii\web\AssetBundle;

class MetronicAsset extends AssetBundle
{
     public $basePath = '@webroot';
     public $baseUrl = '@web';
     public $css = [
          'dist/metronic/vendors.bundle.css',
         'dist/metronic/style.bundle.css',
     ];
     public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];

     public $js = [
          'dist/metronic/vendors.bundle.js',
          'dist/metronic/scripts.bundle.js',

     ];
     public $depends = [
         //'yii\bootstrap\BootstrapAsset',
     ];
}
