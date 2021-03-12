<?php

namespace frontend\widgets;

use common\models\Country;
use frontend\widgets\ActiveForm;
use frontend\models\PersonalDataForm;
use yii\base\Widget;

use Yii;
use yii\helpers\ArrayHelper;

class PersonalDataWidget extends Widget
{
	/**
	 * @var bool
	 */
	public $insert = true;

	public $form;

	private $model;

	public $fieldSize = '3-7';

	public $fieldOptions = [];

	public function init()
	{
		$this->model = new PersonalDataForm();
		$this->model->load(Yii::$app->request->post());
	}

	/**
	 * @param  bool  $loadData
	 * @return PersonalDataForm
	 */
	public static function getModel($loadData = false)
	{
		$model = new PersonalDataForm();
		if($loadData) {
			$model->load(Yii::$app->request->post());
		}

		return $model;
	}

	/**
	 * @param $attribute
	 * @param  array  $additional
	 * @return array
	 * @throws \Exception
	 */
	public function getFieldOptions($attribute, $additional = [])
	{
		return ArrayHelper::merge(ArrayHelper::getValue($this->fieldOptions, $attribute, []), $additional);
	}

	/**
	 * @return string
	 */
	public function run()
	{
		return $this->render('personalData', [
			'form' 		=> $this->form,
			'fieldSize' => $this->fieldSize,
			'model' 	=> $this->model,
			'countries' => Country::getValidated()->orderBy((new Country())->getLangAttributeName('name'))->all()
		]);
	}
}
