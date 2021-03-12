<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransferCountryAgentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-country-agent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transfer_country_agent_id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'transfer_agent_id') ?>

    <?= $form->field($model, 'eur_course') ?>

    <?= $form->field($model, 'usd_course') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
