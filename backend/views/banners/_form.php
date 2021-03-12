<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => (boolean)$model->is_protected]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'button_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'button_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template')->widget(
        'trntv\aceeditor\AceEditor',
        [
            'mode'=>'html', // programing language mode. Default "html"
            'theme'=>'github', // editor theme. Default "github"
            'readOnly'=> false //$model->is_protected // Read-only mode on/off = true/false. Default "false"
        ]
    ) ?>

    <div class="m-portlet m-portlet--head-solid-bg m-portlet--bordered">
        <div class="m-portlet__head m-portlet__head--fit">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon">
							<i class="flaticon-attachment"></i>
						</span>
                    <h3 class="m-portlet__head-text">
                        Image
                    </h3>
                </div>
            </div>
        </div>
        <?= DetailView::widget([
            'model' => $model,
            'options' => [
                'class' => 'table table-striped m-table',
                'style' => 'margin-bottom:0'
            ],
            'attributes' => [
                [
                    'visible' => !empty($model->image),
                    'attribute'=>'Preview',
                    'value' => $model->previewPath,
                    'format' => ['image', ['width' => '200']],
                ],
                [
                    'visible' => !empty($model->image),
                    'label'=>'Delete image',
                    'value' => function() use ($form, $model) {
                        return  $form->field($model, 'deleteImage', [
                            'options' => ['style' => 'margin-bottom:0']
                        ])->switcher([]);
                    },
                    'format' => 'raw'
                ],
                [
                    'label'=>'Upload image',
                    'value' => function() use ($form, $model) {
                        return  $form->field($model, 'imageFile')->fileInput()->label(false);
                    },
                    'format' => 'raw'
                ],
            ],
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
