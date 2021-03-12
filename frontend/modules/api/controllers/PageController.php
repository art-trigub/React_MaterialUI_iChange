<?php

namespace api\controllers;

use api\components\Controller;
use frontend\models\PageRateForm;

use Yii;

class PageController extends Controller
{
    function actionVote()
    {
        $model = new PageRateForm();
        if($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->vote())
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