<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Chunks';
?>

<div class="content-block-form">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <?=  \backend\widgets\LangButtons::widget([
                    'btnGroupCssClass' => 'm-btn-group',
                    'action' => 'chunks',
                    'model' => $model,
                    'languages' => $langList
                ]) ?>
            </div>
        </div>


    <div class="m-portlet__body">
        <?php $form = ActiveForm::begin([]); ?>

            <?php foreach ($chunks as $name => $value): ?>

                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1"><?= $name ?></label>
                    <?= Html::textInput('Chunks[' . $name . ']', $value, ['class' => 'form-control m-input']); ?>
                </div>

            <?php endforeach; ?>

            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>