<?php
namespace frontend\modules\account;

use yii\filters\AccessControl;
use common\components\AccessRule;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'account\controllers';

    public $urlRules = [
        'prefix' => 'account',
        'rules' => [
            'edit' => 'default/edit',
            'change-password' => 'default/change-password'
        ],
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'ruleConfig' => [
//                    'class' => AccessRule::className(),
//                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        // инициализация модуля с помощью конфигурации, загруженной из config.php
        \Yii::configure($this, require __DIR__ . '/config.php');

    }
}