<?php

use yii\helpers\Html;
use backend\widgets\metronic\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\TransferAgent;
use common\models\TransferType;
use common\models\TransferPickupBank;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyMatrix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-money-matrix-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->errorSummary($model) ?>

	<?= $form->field($model, 'country_id')->dropDownList(
		ArrayHelper::map(Country::find()->all(), 'country_id', 'name')
	) ?>

	<?= $form->field($model, 'transfer_type_id')->dropDownList(
		ArrayHelper::map(TransferType::find()->all(), 'transfer_type_id', 'label')
	) ?>

	<?= $form->field($model, 'transfer_agent_id')->dropDownList(
		ArrayHelper::map(TransferAgent::find()->all(), 'transfer_agent_id', 'label')
	) ?>

	<?php //$form->field($model, 'transfer_pickup_bank_id')->dropDownList(ArrayHelper::map(TransferPickupBank::find()->all(), 'transfer_pickup_bank_id', 'label')) ?>


	<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Sending Amount
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<?= $form->field($model, 'send_ils_exists')->checkbox() ?>

			<?= $form->field($model, 'max_ils_amount')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'send_eur_exists')->checkbox() ?>

			<?= $form->field($model, 'max_eur_amount')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'send_usd_exists')->checkbox() ?>

			<?= $form->field($model, 'max_usd_amount')->textInput(['maxlength' => true]) ?>
		</div>
	</div>


		<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Receive Amount
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<?= $form->field($model, 'receive_ils_exists')->checkbox() ?>

			<?= $form->field($model, 'receive_usd_exists')->checkbox() ?>

			<?= $form->field($model, 'receive_eur_exists')->checkbox() ?>
		</div>
	</div>


	<?php // $form->field($model, 'max_local_amount')->textInput(['maxlength' => true]) ?>


	<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
