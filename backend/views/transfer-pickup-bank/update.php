<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferPickupBank */

$this->title = 'Update Transfer Pickup Bank: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Pickup Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->transfer_pickup_bank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-pickup-bank-update">

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
                <?php /*  \backend\widgets\LangButtons::widget([
                    'btnGroupCssClass' => 'm-btn-group',
                    'model' => $model,
                    'languages' => $langList
                ]) */ ?>
            </div>
        </div>
        <div class="m-portlet__body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
