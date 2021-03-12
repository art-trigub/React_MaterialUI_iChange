<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CurrencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'currency_id') ?>

    <?= $form->field($model, 'currency_icon_id') ?>

    <?= $form->field($model, 'icon') ?>

    <?= $form->field($model, 'symbol') ?>

    <?= $form->field($model, 'icon_path') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'hint') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'middle') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'buy_1') ?>

    <?php // echo $form->field($model, 'sell_1') ?>

    <?php // echo $form->field($model, 'buy_2') ?>

    <?php // echo $form->field($model, 'sell_2') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
