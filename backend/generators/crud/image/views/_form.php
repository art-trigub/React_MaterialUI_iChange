<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
    </div>

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
        <?= "<?= " ?> DetailView::widget([
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

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
