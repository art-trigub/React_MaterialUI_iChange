<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyMatrixSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-money-matrix-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transfer_money_matrix_id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'transfer_type_id') ?>

    <?= $form->field($model, 'transfer_agent_id') ?>

    <?= $form->field($model, 'transfer_pickup_bank_id') ?>

    <?php // echo $form->field($model, 'max_amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
