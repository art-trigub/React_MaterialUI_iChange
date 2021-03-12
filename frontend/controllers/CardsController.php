<?php

namespace frontend\controllers;

use common\models\Card;
use common\models\CardOrder;
use frontend\components\Controller;
use frontend\models\CardOrderForm;
use frontend\widgets\PersonalDataWidget;
use yii\web\UploadedFile;

use Yii;

class CardsController extends Controller
{

	public function actionIndex()
	{
		$models = Card::find()->all();
		return $this->render('index', [
			'models' => $models
		]);
	}

	public function actionDebit()
	{
		$models = Card::findAll(['type_id' => Card::TYPE_DEBIT]);
		return $this->render('index', [
			'models' => $models
		]);
	}

	public function actionCredit()
	{
		$models = Card::findAll(['type_id' => Card::TYPE_CREDIT]);
		return $this->render('index', [
			'models' => $models
		]);
	}

	public function actionPrepaid()
	{
		$models = Card::findAll(['type_id' => Card::TYPE_PREPAID]);
		return $this->render('index', [
			'models' => $models
		]);
	}

	/**
	 * @param $id
	 * @return string|\yii\web\Response
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionOrder($id)
	{
		$model = Card::findOne($id);
		if (!$model) {
			$this->NotFoundException();
		}

		$formModel = new CardOrderForm($model);
		$personalFormModel = PersonalDataWidget::getModel(false);

		if (
			$formModel->load(Yii::$app->request->post()) && $formModel->validate() &&
			$personalFormModel->load(Yii::$app->request->post()) && $personalFormModel->validate() &&
			$formModel->createOrder($personalFormModel)
		) {
			$formModel->sendEmail($personalFormModel);
			$formModel->sendSMS($personalFormModel);

			Yii::$app->session->setFlash('success', Yii::t('app', 'Message sent'));
			return $this->refresh();
		}

		return $this->render('order', compact('model', 'formModel', 'personalFormModel'));
	}
}
