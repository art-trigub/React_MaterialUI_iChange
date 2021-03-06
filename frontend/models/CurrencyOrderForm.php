<?php

namespace frontend\models;

use common\models\CurrencyOrder;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use common\components\AttributeFormatterBehavior;
use yii\base\InvalidValueException;
use \DatePeriod;
use \DateInterval;
use \DateTime;

use Yii;

/**
 * @property-read float|int $resultAmount
 * @property-read DatePeriod $availableDatePeriod
 * @property-read array $availableDates
 * @property mixed amount
 */
class CurrencyOrderForm extends Model
{
	public $currency_id;
	public $acquisition_timestamp;
	public $sent_amount;
	public $amount;
	public $result_amount;
	public $currencyCourse;
	public $acquisitionDateFormatted;

	public $agree;

	private $_currencyOrderModel;
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['currency_id', 'acquisition_timestamp'], 'integer'],
			[['sent_amount', 'amount'], 'number'],

			[['currencyCourse', 'result_amount'], 'safe'],

			['amount', 'compare', 'compareValue' => 0, 'operator' => '>'],

			[['acquisitionDateFormatted'], 'datetime', 'format' => Yii::$app->formatter->dateFormat, 'timestampAttribute' => 'acquisition_timestamp'],
			[['acquisitionDateFormatted'], 'validateDate'],

			[['currency_id', 'acquisitionDateFormatted', 'amount'], 'required'],

			[['agree'], 'required', 'requiredValue' => 1, 'message' => 'Required field'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			[
				'class' => AttributeFormatterBehavior::className(),
				'attributes' => [
					'acquisitionDateFormatted' => 'acquisition_timestamp',
				],
				'formatter' => function($value) {
					return Yii::$app->formatter->asDate($value?:time());
				}
			],
		];
	}

	public function init()
	{
		if(!Yii::$app->user->isGuest) {
			$user = Yii::$app->user->getIdentity();
			$this->setAttributes([
				'first_name'  => $user->first_name,
				'last_name'   => $user->middle_name,
				'passport_id' => $user->passport_number,
				'email'       => $user->email,
				'phone'       => $user->phone
			]);
		}

		parent::init(); // TODO: Change the autogenerated stub
	}

	/**
	 * @param $attribute
	 * @param $params
	 * @throws \Exception
	 */
	public function validateDate($attribute,$params) {

		$period = $this->getAvailableDatePeriod();
		$availableDates = [];
		foreach ($period as $item) {
			$availableDates[] = $item->format("d.m.Y");
		}

		if(!in_array($this->{$attribute}, $availableDates)) {
			$this->addError($attribute, 'Acquisition date error.');
		}
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'currency_id' => Yii::t('app', 'Currency'),
			'status' => Yii::t('app', 'Status'),
			'type' => Yii::t('app', 'Type'),
			'acquisitionDateFormatted' => Yii::t('app', 'Acquisition date'),
			'agree' => Yii::t('app', 'Required field')
		];
	}

	public function getAvailableDates()
	{
		$result = [];
		$period = $this->getAvailableDatePeriod();

		foreach ($period as $item) {
			$result[] = $item->format("d-m-Y");
		}

		return $result;
	}

	/**
	 * @return DatePeriod
	 * @throws \Exception
	 */
	protected function getAvailableDatePeriod()
	{
		return new DatePeriod(
			new DateTime(date('Y-m-d')),
			DateInterval::createFromDateString('1 day'),
			new DateTime(date('Y-m-d') . ' + 3 days')
		);
	}

	/**
	 * @return float|int
	 */
	public function getResultAmount()
	{
		return $this->amount * $this->currencyCourse;
	}

	/**
	 * @return CurrencyOrder|mixed
	 */
	public function getCurrencyOrderModel()
	{
		if(!$this->_currencyOrderModel) {
			$this->_currencyOrderModel = new CurrencyOrder();
		}

		return $this->_currencyOrderModel;
	}

	/**
	 * @param $model
	 */
	public function setCurrencyOrderModel($model)
	{
		if ($model instanceof CurrencyOrder) {
			$this->_currencyOrderModel = $model;
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
		return Yii::$app
			->mailer
			->compose(
				['html' => 'currencyOrder-html', 'text' => 'currencyOrder-text'],
				[
					'model' => $this,
					'order'  => $this->getCurrencyOrderModel(),
					'personalFormModel' => $model
				]
			)
			->setFrom(Yii::$app->storage->get('supportEmail'))
//			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
			->setTo([$model->email, Yii::$app->storage->get('adminEmail')])
			->setSubject(Yii::t('app', 'Currency order') . ' ' . Yii::$app->name)
			->send();

//		var_dump( Yii::$app->mailer->render('currencyOrder-html', [
//			'model' => $this,
//			'order'  => $this->getCurrencyOrderModel(),
//			'personalFormModel' => $model
//		], Yii::$app->mailer->htmlLayout)); exit;
	}

	/**
	 * @param  PersonalDataForm  $model
	 */
	public function sendSMS(PersonalDataForm $model)
	{
		$message = Yii::t(
			'sms',
			'CURRENCY ORDERING. Your order number is: CO{id}. Thanks for contacting us {company}', [
				'company' => 'I-CHANGE',
				'id' 	  => $this->getCurrencyOrderModel()->getModifiedId()
			]
		);

		Yii::$app->sms->send($model->phone, $message);
	}

	/**
	 * @param  \frontend\models\PersonalDataForm  $formModel
	 * @return CurrencyOrder|null
	 */
	public function createOrder(PersonalDataForm $formModel)
	{
		$model = new CurrencyOrder();
		$model->currency_id = $this->currency_id;
		$model->amount = $this->amount;
		$model->amount_ils = $this->resultAmount;
		$model->rate = $this->currencyCourse;
		$model->acquisition_timestamp = $this->acquisition_timestamp;

		$model->person_full_name = $formModel->full_name;
		$model->person_birthday_timestamp = strtotime($formModel->birthday_date);
		$model->person_passport_id = $formModel->passport;
		$model->person_country_id = $formModel->country_id;
		$model->person_email = $formModel->email;
		$model->person_phone = $formModel->getPhone();
		$model->comment = $formModel->office_note;

		$this->setCurrencyOrderModel($model);

		if(!($result = $model->save())) {
			$errors =  $model->getFirstErrors();
			$this->addError('amount', array_shift($errors));
		}

		return $result ? $model : null;
	}
}
