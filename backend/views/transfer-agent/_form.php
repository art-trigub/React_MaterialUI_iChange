<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\TransferAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

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
                    'attribute' => 'Preview',
                    'value' => $model->imagePath,
                    'format' => ['image', ['width' => '200']],
                ],
                [
                    'visible' => !empty($model->image),
                    'label' => 'Delete image',
                    'value' => function () use ($form, $model) {
                        return $form->field($model, 'deleteImage', [
                            'options' => ['style' => 'margin-bottom:0']
                        ])->switcher([]);
                    },
                    'format' => 'raw'
                ],
                [
                    'label' => 'Upload image',
                    'value' => function () use ($form, $model) {
                        return $form->field($model, 'imageFile')->fileInput()->label(false);
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
