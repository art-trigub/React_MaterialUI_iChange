<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\FaqCategory

/* @var $this yii\web\View */
/* @var $model common\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'faq_category_id')->dropDownList(ArrayHelper::map(FaqCategory::find()->all(), 'faq_category_id', 'label')) ?>

    <?= $form->field($model, 'question')->textarea() ?>

    <?= $form->field($model, 'answer')->textarea() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
