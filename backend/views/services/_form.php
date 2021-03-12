<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'sub_title')->textInput() ?>

    <?= $form->field($model, 'keywords')->textarea() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_popular')->dropDownList(['No', 'Yes']) ?>

    <?= $form->field($model, 'body')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'filebrowserBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor']),
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor', 'filter' => 'image']),
        ],
    ]); ?>

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
                    'visible' => (boolean)$model->image,
                    'attribute'=>'Preview',
                    'value' => $model->previewPath,
                    'format' => ['image', ['width' => '200']],
                ],
                [
                    'visible' => (boolean)$model->image,
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
