<?php

namespace frontend\controllers;

use common\models\Page;
use frontend\components\Controller;
use frontend\models\CurrencyOrderForm;
use frontend\widgets\PersonalDataWidget;

use Yii;

class CurrenciesController extends Controller
{
	/**
	 * @return string
	 */
    public function actionIndex()
    {
        return $this->render('index');
    }

	/**
	 * @return string|\yii\web\Response
	 */
    public function actionOrder()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/account/currency-ordering/order']);
        }

        $page = Page::getStaticByName('currency-order');
        $model = new CurrencyOrderForm();
        $personalModel = PersonalDataWidget::getModel(false);
        if (
        	$model->load(Yii::$app->request->post()) && $model->validate() &&
			$personalModel->load(Yii::$app->request->post()) && $personalModel->validate() &&
			$model->createOrder($personalModel)
		) {
			$model->sendEmail($personalModel);
			$model->sendSMS($personalModel);

			Yii::$app->session->setFlash('success', Yii::t('app', 'Data submitted'));
            return $this->refresh();
        }

        return $this->render('order', compact('model', 'personalModel', 'page'));
    }

}
