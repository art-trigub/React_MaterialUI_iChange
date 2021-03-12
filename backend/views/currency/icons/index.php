<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\JsExpression;
?>

<div class="currency-icons-index">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
                    'class' => 'curency-icon-input',
                    'options' => [
                            'class' => 'asdasdasd',
                        'multiple' => true,
                        'showRemove' => false,
                        'accept' => 'image/*'
                    ],
                    'pluginOptions' => [
                        'layoutTemplates' =>  [
                            'footer' => '<div class="file-thumbnail-footer" style ="">' .
                                '  <div class="small" style="margin:15px 0 2px 0">{size}</div> {progress}{indicator}{actions}' .
                                '</div>'
                        ],
                        'previewThumbTags' => [
                            '{DISABLED}' => '',
                            '{id}' => ''
                        ],
                        'initialPreview' => ArrayHelper::getColumn($models, 'imagePath'),
                        'initialPreviewAsData'=>true,
                        'overwriteInitial'=>false,
                        'initialPreviewConfig' => ArrayHelper::toArray($models, [
                            'common\models\CurrencyIcon' => [
                                'currency_icon_id',
                                'key' => function($model) {
                                    return $model->currency_icon_id;
                                },
                                'url' => function($model) {
                                    return Url::to(['/currency/icons/delete-icon', 'id' => $model->currency_icon_id]);
                                },
                            ]
                        ]),
                        'initialPreviewThumbTags' => ArrayHelper::toArray($models, [
                            'common\models\Slide' => [
                                "{NAME}" => function($model) {
                                    return '';
                                },
                                "{DISABLED}" => function($model) {
                                    return '';
                                },
                                "{id}" => function($model) {
                                    return $model->currency_icon_id;
                                }
                            ]
                        ]),
                        'previewFileType' => 'image'
                    ],
                    'pluginEvents' => [
                        'filebatchselected' => 'function(event) {
                            $(".kv-zoom-cache input").attr("disabled", "disabled");
                        }',
                    ]
                ])->label('Currency icons'); ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php


?>
