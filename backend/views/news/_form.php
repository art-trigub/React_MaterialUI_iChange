<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use common\models\News;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    <ul class="nav nav-tabs  m-tabs-line" role="tablist">-->
<!--        <li class="nav-item m-tabs__item">-->
<!--            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_tabs_1_1" role="tab" aria-selected="true">General</a>-->
<!--        </li>-->
<!--        <li class="nav-item m-tabs__item">-->
<!--            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_2" role="tab" aria-selected="true">Related news</a>-->
<!--        </li>-->
<!--    </ul>-->

    <div class="tab-content">
        <div class="tab-pane active show" id="m_tabs_1_1" role="tabpanel">

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'url')->textInput() ?>

            <?= $form->field($model, 'title')->textInput() ?>

            <?= $form->field($model, 'keywords')->textInput() ?>

            <?= $form->field($model, 'description')->textarea() ?>

            <?= $form->field($model, 'is_top')->dropDownList([0 => 'No', 1 => 'Yes']) ?>


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

        </div>

<!--        <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">-->
<!--            --><?php /* Html::tag('related-news', '', [
                ':related' => ArrayHelper::toArray($model->getRelated()->all(), [
                    'common\models\News' => [
                        'news_id', 'previewPath', 'title'
                    ]
                ])]
            ) */ ?>
<!--        </div>-->
    </div>
     <?php ActiveForm::end(); ?>

</div>
