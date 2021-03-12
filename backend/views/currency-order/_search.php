<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CurrencyOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'currency_order_id') ?>

    <?= $form->field($model, 'currency_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'person_full_name') ?>

    <?= $form->field($model, 'person_birthday_timestamp') ?>

    <?php // echo $form->field($model, 'person_passport_id') ?>

    <?php // echo $form->field($model, 'person_country_id') ?>

    <?php // echo $form->field($model, 'person_email') ?>

    <?php // echo $form->field($model, 'person_phone') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'amount_ils') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'acquisition_timestamp') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
