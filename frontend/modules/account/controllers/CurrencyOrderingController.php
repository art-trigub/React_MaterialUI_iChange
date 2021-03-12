<?php

namespace account\controllers;

use account\components\Controller;
use account\models\CurrencyOrderSearch;
use common\models\CurrencyOrder;
use common\models\Page;

use Yii;

class CurrencyOrderingController extends Controller
{
    function actionIndex()
    {
        $model = new CurrencyOrderSearch();

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $model->search()
        ]);
    }

    function actionOrder()
    {
        $model = new CurrencyOrder();
        $page = Page::getStaticByName('currency-order');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }

            return $this->redirect(['/account/currency-ordering']);
        }

        return $this->render('@frontend/views/currencies/order', [
            'model' => $model,
            'page' => $page
        ]);
    }
}