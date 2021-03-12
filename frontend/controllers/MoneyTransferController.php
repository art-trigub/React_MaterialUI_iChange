<?php

namespace frontend\controllers;

use common\models\Country;
use common\models\Currency;
use common\models\TransferAgent;
use common\models\TransferCountryAgent;
use common\models\TransferMoneyCommission;
use common\models\TransferMoneyMatrix;
use common\models\TransferMoneyRequest;
use common\models\TransferType;
use frontend\models\MoneyTransferForm;
use frontend\widgets\PersonalDataWidget;
use yii\db\Expression;
use yii\filters\VerbFilter;

use yii\helpers\Html;
use yii\helpers\Json;
use frontend\components\Controller;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\traits\MoneyTransferTrait;

class MoneyTransferController extends Controller
{
	use MoneyTransferTrait;

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete-beneficiary' => ['POST'],
				],
			],
			[
				'class' => 'common\filters\JsonFormatter',
				'only' => [
					'get-transfer-types',
					'get-transfer-agents',
					'get-amount-data'
				]
			]
		];
	}

	/**
	 * @return string|\yii\web\Response
	 * @throws \Exception
	 */
	public function actionIndex()
	{
		$model = new MoneyTransferForm();
		$personalFormModel = PersonalDataWidget::getModel(false);
		if (
			$model->load(Yii::$app->request->post()) && $model->validate() &&
			$personalFormModel->load(Yii::$app->request->post()) && $personalFormModel->validate() &&
			$model->createRequest($personalFormModel)
		) {
			$model->sendEmail($personalFormModel);
			$model->sendSMS($personalFormModel);

			Yii::$app->session->setFlash('success', Yii::t('app', 'Data submitted'));
			return $this->refresh();
		}

		$this->registerJsConfig();

		return $this->render(
			'index',
			[
				'model' => $model,
				'countries' => Country::find()->where(['visible' => 1])->all()
			]
		);
	}

	/**
	 * @param $country_id
	 * @return array
	 */
	public function actionGetTransferTypes($country_id)
	{
		$models = TransferType::find()->alias('t')->innerJoin(
			['tmm' => TransferMoneyMatrix::tableName()],
			[
				't.transfer_type_id' => new Expression('tmm.transfer_type_id')
			]
		)->where(['tmm.country_id' => $country_id])->all();

		return ArrayHelper::index(
			ArrayHelper::toArray(
				$models,
				[
					'common\models\TransferType' => [
						'transfer_type_id',
						'name',
						'label'
					]
				]
			),
			'transfer_type_id'
		);
	}

	public function actionGetTransferAgents($country_id, $transfer_type_id)
	{
		$models = TransferAgent::find()->alias('t')->innerJoin(
			['tmm' => TransferMoneyMatrix::tableName()],
			[
				't.transfer_agent_id' => new Expression('tmm.transfer_agent_id')
			]
		)->where(
			[
				'tmm.country_id' => $country_id,
				'tmm.transfer_type_id' => $transfer_type_id
			]
		)->all();

		return ArrayHelper::index(
			ArrayHelper::toArray(
				$models,
				[
					'common\models\TransferAgent' => [
						'transfer_agent_id',
						'image' => function ($model) {
							return $model->image ? $model->getImagePath() : '';
						},
						'label'
					]
				]
			),
			'transfer_agent_id'
		);
	}

	/**
	 * @param $country_id
	 * @param $transfer_type_id
	 * @param $transfer_agent_id
	 * @return array
	 */
	public function actionGetAmountData($country_id, $transfer_type_id, $transfer_agent_id)
	{
		$matrix = TransferMoneyMatrix::find()->where(
			[
				'country_id' => $country_id,
				'transfer_type_id' => $transfer_type_id,
				'transfer_agent_id' => $transfer_agent_id
			]
		)->one() ?: new TransferMoneyMatrix();

		$commissions = TransferMoneyCommission::findAll(
			[
				'transfer_money_matrix_id' => $matrix->transfer_money_matrix_id
			]
		);

		$countryAgentCourse = TransferCountryAgent::find()->where(
			[
				'country_id' => $country_id,
				'transfer_agent_id' => $transfer_agent_id
			]
		)->one() ?: new TransferCountryAgent;

		$receiveCurrencyNames = $sendCurrencyNames = [];
		if ($matrix->country && $matrix->country->currency && $matrix->receive_ils_exists) {
			$receiveCurrencyNames[] = $matrix->country->currency->name;
		}
		$matrix->receive_eur_exists && $receiveCurrencyNames[] = 'EUR';
		$matrix->receive_usd_exists && $receiveCurrencyNames[] = 'USD';

		$matrix->send_eur_exists && $sendCurrencyNames[] = 'EUR';
		$matrix->send_usd_exists && $sendCurrencyNames[] = 'USD';
		$matrix->send_ils_exists && $sendCurrencyNames[] = 'ILS';

		return [
			'commissions' => ArrayHelper::toArray(
				$commissions,
				[
					'common\models\TransferMoneyCommission' => [
						'dia_from',
						'dia_to',
						'value',
						'type'
					]
				]
			),
			'countryAgentCourse' => ArrayHelper::toArray(
				$countryAgentCourse,
				[
					'common\models\TransferCountryAgent' => [
						'LOCAL' => function ($model) {
							return 0;
						},
						'EUR' => function ($model) {
							return $model->eur_course ?: 0;
						},
						'USD' => function ($model) {
							return $model->usd_course ?: 0;
						}
					]
				]
			),
			'sendCurrencyNames' => array_unique($sendCurrencyNames),
			'receiveCurrencyNames' => array_unique($receiveCurrencyNames),
			'maxAmount' => ArrayHelper::toArray(
				$matrix,
				[
					'common\models\TransferMoneyMatrix' => [
						'LOCAL' => function ($model) {
							return $model->max_local_amount ?: 0;
						},
						'EUR' => function ($model) {
							return $model->max_eur_amount ?: 0;
						},
						'USD' => function ($model) {
							return $model->max_usd_amount ?: 0;
						}
					]
				]
			)
		];
	}

}
