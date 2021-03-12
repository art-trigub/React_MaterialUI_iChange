<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\ContentBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => $model->is_protected]) ?>

    <?= $form->field($model, 'body')->widget(
        'trntv\aceeditor\AceEditor',
        [
            'mode'=>'html', // programing language mode. Default "html"
            'theme'=>'github', // editor theme. Default "github"
            'readOnly'=>'false' // Read-only mode on/off = true/false. Default "false"
        ]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= !$model->isNewRecord ? Html::submitButton('Restore', ['class' => 'btn btn-info', 'name' => 'restore', 'value' => 'restore']) : "" ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
