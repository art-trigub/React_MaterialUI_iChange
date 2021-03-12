<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Update Contacts: (' . $model->language . ')';
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="page-update">

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
                <?= \backend\widgets\LangButtons::widget([
                    'btnGroupCssClass' => 'm-btn-group',
                    'model' => $model,
                    'action' => 'contacts',
                    'languages' => $langList
                ]) ?>
            </div>

        </div>
        <div class="m-portlet__body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'phone_1')->textInput() ?>

            <?= $form->field($model, 'phone_2')->textInput() ?>

            <?= $form->field($model, 'phone_3')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'whatsapp')->textInput() ?>

            <?= $form->field($model, 'facebook')->textInput() ?>

            <?= $form->field($model, 'line')->textInput() ?>

            <?= $form->field($model, 'wechat')->textInput() ?>

            <?= $form->field($model, 'viber')->textInput() ?>

            <?= $form->field($model, 'skype')->textInput() ?>

            <?= $form->field($model, 'address')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'full',
                    'inline' => false,
                    'filebrowserBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor']),
                    'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor', 'filter' => 'image']),
                ],
            ]); ?>

            <?= $form->field($model, 'working_hours')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'base',
                    'inline' => false,
                    'filebrowserBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor']),
                    'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor', 'filter' => 'image']),
                ],
            ]); ?>

            <?= $form->field($model, 'body')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'full',
                    'inline' => false,
                    'filebrowserBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor']),
                    'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['elfinder/ckeditor', 'filter' => 'image']),
                ],
            ]); ?>

            <?= $form->field($model, 'map')->widget(
                'trntv\aceeditor\AceEditor',
                [
                    'mode'=>'html', // programing language mode. Default "html"
                    'theme'=>'github', // editor theme. Default "github"
                    'readOnly'=>'false' // Read-only mode on/off = true/false. Default "false"
                ]
            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
