<?php


namespace frontend\models;

use common\models\Card;
use common\models\CardOrder;
use yii\base\Model;
use Yii;

class CardOrderForm extends Model
{
	/**
	 * @var Card
	 */
	private $_card;

	/**
	 * @var CardOrder
	 */
	private $_order;

	public $full_name;

	public $first_name;

	public $last_name;

	public $birthday;

	public $email;

	public $phone;

	public $passport;

	public $country;

	public $city;

	public $address;

	public $verifyCode;

	public $agree;

	public $id;

	/**
	 * @var UploadedFile[]
	 */
	public $imageFiles;

	/**
	 * CardOrderForm constructor.
	 *
	 * @param  Card  $card
	 * @param  array  $config
	 */
	public function __construct(Card $card, $config = [])
	{
		$this->_card = $card;

		parent::__construct($config);
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			// name, email, subject and body are required
			//[['first_name', 'last_name', 'birthday', 'email', 'phone', 'passport', 'country', 'city', 'address'], 'required'],
//            [['full_name', 'birthday', 'country', 'passport', 'email', 'phone'], 'required'],
			// email has to be a valid email address
//            ['email', 'email'],
			// verifyCode needs to be entered correctly
			//['verifyCode', 'captcha'],
			['id', 'default', 'value' => rand(100000, 999999)],
			['agree', 'required', 'requiredValue' => 1, 'message' => Yii::t('app', 'Is required field')],

			[['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'full_name' => Yii::t('app', 'Full Name'),
			'verifyCode' => Yii::t('app', 'Verification Code'),
			'imageFiles' => Yii::t('app', 'Documents'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'phone' => Yii::t('app', 'Phone'),
			'birthday' => Yii::t('app', 'Birthday'),
			'email' => Yii::t('app', 'E-mail'),
			'passport' => Yii::t('app', 'Passport number'),
			'country' => Yii::t('app', 'Country'),
			'city' => Yii::t('app', 'City'),
			'address' => Yii::t('app', 'Address'),
		];
	}

	public function upload()
	{
		if ($this->validate()) {
			foreach ($this->imageFiles as $file) {
				$file->saveAs('uploads/'.$file->baseName.'.'.$file->extension);
			}
			return true;
		} else {
			return false;
		}
	}

	public function sendEmail(PersonalDataForm $model)
	{
		Yii::$app->mailer->compose(
			['html' => 'cardOrder-html', 'text' => 'cardOrder-text'],
			[
				'card' => $this->_card,
				'personModel' => $model,
				'order' => $this->_order,
				'model' => $this
			]
		)
			->setFrom(Yii::$app->storage->get('supportEmail'))
//			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
			->setTo([$model->email, Yii::$app->storage->get('adminEmail')])
			->setSubject('Card order')
			->send();

//        var_dump( Yii::$app->mailer->render('cardOrder-html', [
//			'card' => $this->_card,
//			'personModel' => $model,
//			'order' => $this->_order,
//			'model' => $this
//        ], Yii::$app->mailer->htmlLayout)); exit;
	}

	public function sendSMS(PersonalDataForm $model)
	{
		$message = Yii::t(
			'sms',
			'PREPAID CARD. Your order number is: PC{id}. Thanks for contacting us {company}',
			[
				'company' => 'I-CHANGE',
				'id' => $this->_order->getModifiedId(),
			]
		);

		Yii::$app->sms->send($model->phone, $message);
	}

	/**
	 * @param  PersonalDataForm  $dataForm
	 * @return CardOrder|null
	 */
	public function createOrder(PersonalDataForm $dataForm)
	{
		$order = new CardOrder();
		$order->card_id = $this->_card->card_id;
		$order->customer_name = $dataForm->full_name;
		$order->customer_birthday = $dataForm->birthday_date;
		$order->customer_id = $dataForm->passport;
		$order->country_id = $dataForm->country_id;
		$order->customer_email = $dataForm->email;
		$order->customer_phone = $dataForm->getPhone();
		$order->comment = $dataForm->office_note;

		if(!$order->validate()) {
			$this->addError('id', $order->getFirstErrors());
			return null;
		}

		return ($this->_order = ($order->save() ? $order : null));
	}
}
