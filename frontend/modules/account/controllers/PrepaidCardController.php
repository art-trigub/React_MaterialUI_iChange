<?php

namespace account\controllers;

use account\components\Controller;
use account\models\TransactionSearch;
use common\models\Transaction;

use Yii;

class PrepaidCardController extends Controller
{
    function actionIndex()
    {
        $model = new TransactionSearch();

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $model->search()
        ]);
    }
}