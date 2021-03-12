<?php

namespace backend\controllers;

use alexantr\elfinder\CKEditorAction;
use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\InputFileAction;
use alexantr\elfinder\TinyMCEAction;
use backend\assets\MetronicAsset;
use Yii;
use backend\components\Controller;

class ElfinderController extends Controller
{

    public function beforeAction($action)
    {
        MetronicAsset::register($this->getView());
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

//    public function init()
//    {
//        parent::init(); // TODO: Change the autogenerated stub
//        MetronicAsset::register($this->getView());
//    }

    public function actions()
    {
        return [
            'connector' => [
                'class' => ConnectorAction::className(),
                'options' => [
                    'roots' => [
                        [
                            'driver' => 'LocalFileSystem',
                            'path' => Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads',
                            'URL' => Yii::getAlias('@web') . '/uploads/',
                            'mimeDetect' => 'internal',
                            'imgLib' => 'gd',
//                            'accessControl' => function ($attr, $path) {
//                                // hide files/folders which begins with dot
//                                return (strpos(basename($path), '.') === 0) ?
//                                    !($attr == 'read' || $attr == 'write') :
//                                    null;
//                            },
                        ],
                    ],
                ],
            ],
            'input' => [
                'class' => InputFileAction::className(),
                'connectorRoute' => 'connector',
            ],
            'ckeditor' => [
                'class' => CKEditorAction::className(),
                'connectorRoute' => 'connector',
            ]
        ];
    }
}