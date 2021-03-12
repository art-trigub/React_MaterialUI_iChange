<?php

namespace frontend\models;

use common\models\Beneficiary;
use common\models\Country;
use common\models\Currency;
use common\models\TransferAgent;
use common\models\TransferMoneyCommission;
use common\models\TransferMoneyMatrix;
use common\models\TransferMoneyRequest;
use common\models\TransferType;
use yii\base\InvalidValueException;
use yii\base\Model;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property-read \common\models\TransferType $transferType
 * @property-read array $currencyList
 * @property-read float|int $transferFee
 * @property-read \common\models\Beneficiary $beneficiary
 * @property-read \common\models\TransferAgent $transferAgent
 * @property-read \common\models\Currency $receiveCurrency
 * @property-read \common\models\Currency $sendCurrency
 * @property-read \common\models\Country $country
 * @property-read mixed $transferMoneyMatrix
 * @property TransferMoneyRequest|mixed|null requestModel
 */
class MoneyTransferForm extends Model
{
	public $country_id;
	public $transfer_type_id;
	public $transfer_agent_id;
	public $send_amount;
	public $send_currency;
	public $cross_course_rate;
	public $receive_amount;
	public $receive_currency;
	public $comment;
	public $commission;

	public $total_to_pay;
	public $fee;
	public $course;

	public $sender_fullname;
	public $sender_citizenship;
	public $sender_id;
	public $sender_email;
	public $sender_phone;

	public $receiver_fullname;
	public $receiver_id;
	public $receiver_country;
	public $receiver_city;
	public $receiver_phone;

	public $agree;

	/**
	 * @var TransferMoneyRequest
	 */
	private $_requestModel;


	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['country_id', 'transfer_type_id', 'transfer_agent_id'], 'integer'],
			[['total_to_pay', 'fee', 'course', 'cross_course_rate'], 'safe'],

			[['country_id', 'transfer_type_id', 'transfer_agent_id', 'send_amount', 'receive_amount'], 'required'],

			[['send_amount', 'receive_amount', 'commission'], 'number'],

			[['comment', 'send_currency', 'receive_currency'], 'string'],

			[['agree'], 'required', 'requiredValue' => 1, 'message' => 'Required field']
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'transfer_money_request_id' => 'Transfer Money Request ID',
			'beneficiary_id' => Yii::t('app', 'Beneficiary'),
			'country_id' => Yii::t('app', 'Country'),
			'transfer_type_id' => Yii::t('app', 'Transfer Type'),
			'transfer_agent_id' => Yii::t('app', 'Transfer Agent'),
			'amount_from' => 'Amount From',
			'amount_to' => 'Amount To',
			'currency_from_id' => 'Currency From ID',
			'currency_to_id' => 'Currency To ID',
			'destination_id' => Yii::t('app', 'Destination'),
			'phone_number' => Yii::t('app', 'Phone Number'),
			'card_number' => Yii::t('app', 'Card Number'),
			'bank_name' => Yii::t('app', 'Bank Name'),
			'bank_code' => Yii::t('app', 'Swift Code'),
			'branch_name' => 'Branch Name',
			'add_bank' => Yii::t('app', 'Bank address'),
			'accunt_number' => 'Accunt Number',
			'updated_at' => Yii::t('app', 'Updated At'),
			'created_at' => Yii::t('app', 'Created At'),
			'status' => Yii::t('app', 'Status'),
		];
	}

//	public function getTransferType()
//	{
//		return TransferType::findOne($this->transfer_type_id) ?: new TransferType();
//	}

//	public function getTransferAgent()
//	{
//		return TransferAgent::findOne($this->transfer_agent_id) ?: new TransferAgent();
//	}

//	public function getBeneficiary()
//	{
//		return Beneficiary::findOne($this->beneficiary_id) ?: new Beneficiary();
//	}

//	public function getCountry()
//	{
//		return Country::findOne($this->country_id) ?: new Country();
//	}

//	public function getTransferMoneyMatrix()
//	{
//		return TransferMoneyMatrix::findOne(
//			[
//				'country_id' => $this->country_id,
//				'transfer_type_id' => $this->transfer_type_id,
//				'transfer_agent_id' => $this->transfer_agent_id
//			]
//		);
//	}
//
//	/**
//	 * @param $transfer_money_matrix_id
//	 * @return TransferMoneyCommission[]
//	 */
//	public function getCommissions($transfer_money_matrix_id)
//	{
//		return TransferMoneyCommission::findAll(
//			[
//				'transfer_money_matrix_id' => $transfer_money_matrix_id
//			]
//		);
//	}

//	/**
//	 * @return array
//	 */
//	public function getCurrencyList()
//	{
//		$currencyList = Currency::findAll(
//			[
//				'in',
//				'name',
//				[
//					$this->send_currency,
//					$this->receive_currency,
//					'USD'
//				]
//			]
//		);
//
//		$currencyList = ArrayHelper::toArray(
//			$currencyList,
//			[
//				'common\models\Currency' => [
//					'name',
//					'id',
//					'crossrate' => function ($model) {
//						return (float)($model->transfer ?: $model->buy_1_result);
//					}
//				]
//			]
//		);
//
//		return ArrayHelper::index(
//			$currencyList,
//			'name'
//		);
//	}

//	/**
//	 * @return float|int
//	 */
//	public function getTransferFee()
//	{
//		$result = 0;
//		$sendAmount = $this->send_amount;
//		$matrix = $this->getTransferMoneyMatrix();
//		$commissions = $this->getCommissions($matrix->transfer_money_matrix_id);
//		$currencies = $this->getCurrencyList();
//
//		if ($this->send_currency == 'ILS') {
//			$sendAmount /= $currencies['USD']->crossrate;
//		}
//
//		foreach ($commissions as $commission) {
//			if ($sendAmount >= $commission->dia_from && ($sendAmount <= $commission->dia_to || !$commission->dia_to)) {
//				$result = $commission->type == 'n' ?
//					$commission->value :
//					$sendAmount * $commission->value / 100;
//
//				break;
//			}
//		}
//
//		return $result;
//	}

	/**
	 * @return array
	 */
	public function getCurrencyList()
	{
		$list = Currency::find()->where([
			'in', 'name', [
				$this->send_currency,
				$this->receive_currency,
				'USD'
			]
		])->all();

		return ArrayHelper::map($list, 'name', 'currency_id');
	}

	/**
	 * @return TransferMoneyRequest
	 */
	public function getRequestModel()
	{
		if (!$this->_requestModel) {
			$this->_requestModel = new TransferMoneyRequest();
		}

		return $this->_requestModel;
	}

	/**
	 * @param $model
	 */
	public function setRequestModel($model)
	{
		if ($model instanceof TransferMoneyRequest) {
			$this->_requestModel = $model;
		} else {
			throw new InvalidValueException('The $requestModel must be TransferMoneyRequest Class.');
		}
	}

	/**
	 * @param  PersonalDataForm  $model
	 * @return bool
	 */
	public function sendEmail(PersonalDataForm $model)
	{
		return Yii::$app->mailer
			->compose(
				['html' => 'moneyTransfer-html', 'text' => 'moneyTransfer-text'],
				[
					'model' => $this,
					'request' => $this->getRequestModel(),
					'personalModel' => $model
				]
			)
			->setFrom(Yii::$app->storage->get('supportEmail'))
			->setTo([$model->email, Yii::$app->storage->get('adminEmail')])
			->setSubject(Yii::t('app', 'Money transfer request'))
			->send();

//		var_dump(Yii::$app->mailer->render('moneyTransfer-html', [
//			'model' => $this,
//			'request' => $this->getRequestModel(),
//			'personalModel' => $model
//		], Yii::$app->mailer->htmlLayout));
//		exit;
	}

	/**
	 * @param  PersonalDataForm  $model
	 */
	public function sendSMS(PersonalDataForm $model)
	{
		$message = Yii::t(
			'sms',
			'MONEY TRANSFER. Your order number is: MT{id}. Thanks for contacting us {company}',
			[
				'company' => 'I-CHANGE',
				'id' => $this->getRequestModel()->getModifiedId()
			]
		);

		Yii::$app->sms->send($model->phone, $message);
	}

	/**
	 * @param  PersonalDataForm  $formModel
	 * @return TransferMoneyRequest|null
	 * @throws \Exception
	 */
	public function createRequest(PersonalDataForm $formModel)
	{
		$currencyList = $this->getCurrencyList();

		$requestModel = new TransferMoneyRequest();
		$requestModel->country_id = $this->country_id;
		$requestModel->transfer_type_id = $this->transfer_type_id;
		$requestModel->transfer_agent_id = $this->transfer_agent_id;
		$requestModel->send_amount = $this->send_amount;
		$requestModel->receive_amount = $this->receive_amount;
		$requestModel->send_currency_id = ArrayHelper::getValue($currencyList, $this->send_currency, null);
		$requestModel->receive_currency_id = ArrayHelper::getValue($currencyList, $this->receive_currency, null);
		$requestModel->commission = $this->commission;
		$requestModel->total_amount = $this->total_to_pay;

		$requestModel->person_full_name = $formModel->full_name;
		$requestModel->person_birthday_timestamp = strtotime($formModel->birthday_date);
		$requestModel->person_passport_id = $formModel->passport;
		$requestModel->person_country_id = $formModel->country_id;
		$requestModel->person_email = $formModel->email;
		$requestModel->person_phone = $formModel->getPhone();
		$requestModel->comment = $formModel->office_note;

		$this->setRequestModel($requestModel);

		if (!($result = $requestModel->save())) {
			$errors = $requestModel->getFirstErrors();
			$this->addError('send_amount', array_shift($errors));
		}

		return $result ? $requestModel : null;
	}
}
