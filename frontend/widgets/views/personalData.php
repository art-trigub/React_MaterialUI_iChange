<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use fontend\widgets\DatePicker;
use yii\web\JsExpression;

?>

<div class="form__block personal-data">
	<?= $form->field($model, 'full_name', ['size' => $fieldSize])->textInput($this->context->getFieldOptions('full_name')) ?>

	<?= $form->field($model, 'birthday_date', ['size' => $fieldSize])->widget(frontend\widgets\DatePicker::className(), [
		'options' => $this->context->getFieldOptions('birthday_date', [
			'autocomplete' => 'nope',
		]),
		'layout' => '{input}{picker}',
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'dd.mm.yyyy',
			'todayHighlight' => true,
		]
	]) ?>

	<?= $form->field($model, 'passport', ['size' => $fieldSize])->textInput($this->context->getFieldOptions('passport')) ?>

	<?= $form->field($model, 'country_id', ['size' => $fieldSize])->dropDownList(ArrayHelper::map($countries, 'country_id', 'name'),
		$this->context->getFieldOptions('country_id', [
			'prompt' => Yii::t('app', 'Select country')
		]))
	?>

	<?= $form->field($model, 'email', ['size' => $fieldSize])->textInput($this->context->getFieldOptions('email')) ?>

	<?php
    if (Yii::$app->language == 'he') {
        echo $form->field($model, 'phone_number', [
            'size' => $fieldSize,
            'template' => "
			{beginLabelWrapper}\n
				{label}\n
			{endLabelWrapper}\n
			{beginFieldWrapper}\n
				{beginWrapper}\n
					<div class=\"uk-grid\" uk-grid>
					<div class=\"uk-width-1-2\">
							{input}\n
							{error}\n
						</div>
						
						<div class=\"uk-width-1-4\">
							". $form->field($model, 'phone_code', [
                    'options' => ['class' => ''],
                    'template' => '{input}'
                ])->dropDownList($model->phoneCodes) ."\n
						</div>
						<div class=\"uk-width-1-4\">
							". $form->field($model, 'phone_prefix', [
                    'options' => ['class' => ''],
                    'template' => '{input}'
                ])->textInput(['readonly' => true]) ."\n
						</div>
					</div>
					
				{endWrapper}\n
			{endFieldWrapper}\n
			{hint}"
        ])->textInput($this->context->getFieldOptions('phone_number'));
    } else {
        echo $form->field($model, 'phone_number', [
            'size' => $fieldSize,
            'template' => "
			{beginLabelWrapper}\n
				{label}\n
			{endLabelWrapper}\n
			{beginFieldWrapper}\n
				{beginWrapper}\n
					<div class=\"uk-grid\" uk-grid>
						<div class=\"uk-width-1-4\">
							". $form->field($model, 'phone_prefix', [
                    'options' => ['class' => ''],
                    'template' => '{input}'
                ])->textInput(['readonly' => true]) ."\n
						</div>
						<div class=\"uk-width-1-4\">
							". $form->field($model, 'phone_code', [
                    'options' => ['class' => ''],
                    'template' => '{input}'
                ])->dropDownList($model->phoneCodes) ."\n
						</div>
						<div class=\"uk-width-1-2\">
							{input}\n
							{error}\n
						</div>
					</div>
					
				{endWrapper}\n
			{endFieldWrapper}\n
			{hint}"
        ])->textInput($this->context->getFieldOptions('phone_number'));
    }

	?>

	<?= $form->field($model, 'office_note', ['size' => $fieldSize])->textarea($this->context->getFieldOptions('office_note', [
	        'rows' => 5
    ])) ?>


<!--	--><?php //$form->field($model, 'agree', ['size' => '3-7'])
//		->checkbox()
//		->label(Yii::t('app', 'I agree to') . ' ' . Html::a(Yii::t('app', 'Terms of Use'), ['/terms-of-use'])) ?>
</div>
