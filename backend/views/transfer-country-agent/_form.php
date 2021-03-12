<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Country;
use common\models\TransferAgent;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\TransferCountryAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-country-agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(Country::find()->all(), 'country_id', 'name')) ?>

    <?= $form->field($model, 'transfer_agent_id')->dropDownList(ArrayHelper::map(TransferAgent::find()->all(), 'transfer_agent_id', 'name')) ?>

    <?= $form->field($model, 'eur_course')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usd_course')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
