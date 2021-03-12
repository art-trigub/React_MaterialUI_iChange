<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\CardOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'card_id')->dropDownList(ArrayHelper::map($cards, 'card_id', 'name')) ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_birthday')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map($countries, 'country_id', 'name')) ?>

    <?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
