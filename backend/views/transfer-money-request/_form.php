<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-money-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'beneficiary_id')->textInput() ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'transfer_type_id')->textInput() ?>

    <?= $form->field($model, 'transfer_agent_id')->textInput() ?>

    <?= $form->field($model, 'send_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receive_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'send_currency_id')->textInput() ?>

    <?= $form->field($model, 'receive_currency_id')->textInput() ?>

    <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_birthday_timestamp')->textInput() ?>

    <?= $form->field($model, 'person_passport_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_country_id')->textInput() ?>

    <?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'destination_id')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
