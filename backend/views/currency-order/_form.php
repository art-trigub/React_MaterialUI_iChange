<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CurrencyOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'person_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_birthday_timestamp')->textInput() ?>

    <?= $form->field($model, 'person_passport_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_country_id')->textInput() ?>

    <?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_ils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
