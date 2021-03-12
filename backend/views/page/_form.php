<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use common\models\Page;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['disabled' => $model->type == PAGE::PAGE_TYPE_STATIC]) ?>

    <?= $form->field($model, 'label')->textInput() ?>

    <?php if(!$isStatic): ?>
    <?php
        $pagesOptions = Page::getPagesOptions($model->getPagesList());
        unset($pagesOptions[$model->page_id]);
    ?>
        <?= $form->field($model, 'pid')->widget(Select2::classname(), [
            'data' => $pagesOptions,
            'options' => [
                'placeholder' => 'Select a parent page ...',
                'options' => [
                    $model->page_id => ['disabled' => true],
                    $model->pid => ['disabled' => true],
                ]
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'category')->widget(Select2::classname(), [
            'data' => $model->getPageCategories(),
            'options' => [
                'placeholder' => 'Select page category...',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?php endif; ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'external_url')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'sub_title')->textarea() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'body')->widget(CKEditor::className(),[
        'editorOptions' => [
            'allowedContent' => true,
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
                        Desktop Image
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
