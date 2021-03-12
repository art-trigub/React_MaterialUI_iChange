<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'full_name')->textInput() ?>

    <?= $form->field($model, 'visible')->dropDownList(['No', 'Yes']) ?>

    <?= $form->field($model, 'for_order')->dropDownList(['No', 'Yes']) ?>

    <?= $form->field($model, 'multiple_value')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
