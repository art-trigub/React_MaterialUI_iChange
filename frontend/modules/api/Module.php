<?php
namespace frontend\modules\api;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\controllers';

    public function init()
    {
        parent::init();
        // инициализация модуля с помощью конфигурации, загруженной из config.php
        \Yii::configure($this, require __DIR__ . '/config.php');

    }
}