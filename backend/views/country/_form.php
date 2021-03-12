<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\TransferType;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList(ArrayHelper::map(Currency::find()->all(), 'currency_id', 'name'), [
        'prompt' => [
            'text' => 'Select currency',
            'options' => ['selected' => true, 'disabled' => true]
        ]
    ]); ?>

	<?= $form->field($model, 'visible')->dropDownList(['No', 'Yes']); ?>

    <?= $form->field($model, 'phone_code')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
