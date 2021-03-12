<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'storage', 'frontend\components\ModuleUrlRules'],
    'controllerNamespace' => 'frontend\controllers',
    'name' => 'I-Change',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        '/css/bootstrap.css'
                    ]
                ],
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'async' => 'async'
                    ],
                ],
            ]
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '127.0.0.1:9200'],
                // configure more hosts if you have a cluster
            ],
        ],
        'request' => [
			'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'tmpl' => [
            'class' => 'frontend\components\Tmpl',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'on afterLogin' => function($event) {
                Yii::$app->user->identity->updateAttributes(['last_visit' => time()]);
            }
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'jsConfig' => [
            'class' => 'common\components\JsConfig',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'xx-XX', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => -1,
                    'enableCaching' => false,
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'languages' => ['en', 'he', 'ru'],
            'enableDefaultLanguageUrlCode' => true,
            'enableLanguagePersistence' => false,
            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                //'#^site/(login|register)#' => '#^(signin|signup)#',
            ],
            'rules' => [
                ['class' => 'frontend\components\NewsUrlRule'],
                ['class' => 'frontend\components\PageUrlRule'],
                ['class' => 'frontend\components\ServiceUrlRule'],
                ['class' => 'frontend\components\CardUrlRule'],
                ['class' => 'frontend\components\FaqUrlRule'],
                ['class' => 'frontend\components\CurrencyOrderUrlRule'],
                '<_a:(about|contacts)>' => 'page/<_a>',

                'services/<id:\d+>' => 'services/view',
                'page/<id:\d+>' => 'page/view',
                'news/<id:\d+>' => 'news/view',
                'cards/<id:\d+>' => 'news/view',
                'faq/category/<category_id:\d+>' => 'faq/index',

                //'<module>/<controller>' => '<module>/<controller>/index',
                'account' => 'account/default/index',
                '<controller>' => '<controller>/index',
                //'<controller>/<action>' => '<controller>/<action>',
                //['class' => 'app\components\CatalogUrlRule'],
            ]
        ],

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//            ],
//        ],

    ],
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module'
        ],

        'account' => [
            'class' => 'frontend\modules\account\Module'
        ],

        'gridview' => [
            'class' => 'kartik\grid\Module',
            // other module settings
        ],

        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
            'tmpDir' => '@runtime',
            //'controllerNamespace' => 'app\controllers',
            //'allowedIPs' => ['*'],  // IP addresses from which the translation interface is accessible.
            //'roles' => ['@'],//[User::ROLE_ADMIN], //@
            //'tmpDir' => '@runtime/'
        ],
    ],
    'params' => $params,
];
