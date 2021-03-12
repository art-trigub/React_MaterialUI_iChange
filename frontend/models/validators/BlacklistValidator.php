<?php

namespace frontend\models\validators;

use common\models\Blacklist;
use yii\validators\Validator;

use Yii;

class BlacklistValidator extends Validator
{
	/**
	 * @var
	 */
	public $attributeValue;

	/**
	 * @param  \yii\base\Model  $model
	 * @param  string  $attribute
	 */
	public function validateAttribute($model, $attribute)
	{
		$value = $this->attributeValue ?: $model->{$attribute};
		if(Blacklist::contains(trim($value))) {
			$model->addError($attribute, Yii::t('app', 'Sorry, action is not available'));
		}
	}
}
