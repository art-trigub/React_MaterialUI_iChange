<?php

namespace account\controllers;

use account\components\Controller;
use account\models\AccountSettingsForm;

use Yii;

class SettingsController extends Controller
{
    function actionIndex()
    {
        $model = new AccountSettingsForm();

        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->updated())
        {
            Yii::$app->session->setFlash('success', 'Data saved');
            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    function actionEdit()
    {

    }

    function actionPassword()
    {

    }
}