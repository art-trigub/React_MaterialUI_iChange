<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-money-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transfer_money_request_id') ?>

    <?= $form->field($model, 'beneficiary_id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'transfer_type_id') ?>

    <?php // echo $form->field($model, 'transfer_agent_id') ?>

    <?php // echo $form->field($model, 'send_amount') ?>

    <?php // echo $form->field($model, 'receive_amount') ?>

    <?php // echo $form->field($model, 'send_currency_id') ?>

    <?php // echo $form->field($model, 'receive_currency_id') ?>

    <?php // echo $form->field($model, 'commission') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'person_full_name') ?>

    <?php // echo $form->field($model, 'person_birthday_timestamp') ?>

    <?php // echo $form->field($model, 'person_passport_id') ?>

    <?php // echo $form->field($model, 'person_country_id') ?>

    <?php // echo $form->field($model, 'person_email') ?>

    <?php // echo $form->field($model, 'person_phone') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'destination_id') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
