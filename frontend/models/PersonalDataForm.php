<?php

namespace frontend\models;

use yii\base\Model;
use yii\helpers\Html;
use frontend\models\validators\BlacklistValidator;
use Yii;

/**
 * @property mixed phone
 */
class PersonalDataForm extends Model
{

	public $phone_prefix = 972;

	public $phone_code;

	public $phone_number;

	public $birthday_date;

	public $country_id;

	public $country;

	public $email;

	public $passport;

	public $full_name;

	public $agree;

	public $phoneCodes = [
		'50' => '50',
        '51' => '51',
        '52' => '52',
        '53' => '53',
        '54' => '54',
        '55' => '55',
        '56' => '56',
        '57' => '57',
        '58' => '58',
        '59' => '59',
        '02' => '02',
        '03' => '03',
        '04' => '04',
        '08' => '08',
        '09' => '09',
	];

	public $office_note;

	public function rules()
	{
		return [
			[['full_name', 'birthday_date', 'passport', 'email',  'phone_code', 'phone_prefix', 'phone_number', 'country_id'], 'required'],

			['email', BlacklistValidator::className()],

			['phone_number', BlacklistValidator::className(), 'attributeValue' => $this->getPhone()],

			[['office_note'], 'string'],

			[['email'], 'email'],

			//[['agree'], 'required', 'requiredValue' => 1, 'message' => Yii::t('app', 'Terms of Use is required field')],
		];
	}

	public function attributeLabels()
	{
		return [
			'email' 		=> Yii::t('app', 'E-mail'),
			'birthday_date' => Yii::t('app', 'Date of birth'),
			'passport' 		=> Yii::t('app', 'Id/passport'),
			'full_name' 	=> Yii::t('app', 'Full Name'),
			'country_id'	=> Yii::t('app', 'Country'),
			'office_note'	=> Yii::t('app', 'Office Note')
//			'agree'			=> Yii::t('app', 'I agree to') . ' ' . Html::a(Yii::t('app', 'Terms of Use'), 'asd')
		];
	}

	public function getPhone()
	{
		return $this->phone_prefix . $this->phone_code . $this->phone_number;
	}
}
