<?php

namespace api\controllers;

use api\components\Controller;
use common\models\Subscribe;

use Yii;

class SubscribeController extends Controller
{
    function actionIndex()
    {
        $model = new Subscribe();
        if($model->load(Yii::$app->request->post(), '') && $model->save())
        {
            return [
                'status' => self::STATUS_OK
            ];
        }

        $errors = $model->getFirstErrors();
        return [
            'status' => self::STATUS_ERROR,
            'errors' => array_shift($errors)
        ];
    }
}