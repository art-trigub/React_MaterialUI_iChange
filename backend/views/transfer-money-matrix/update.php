<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyMatrix */

$this->title = 'Update Transfer Money Matrix: ' . $model->transfer_money_matrix_id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Money Matrices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transfer_money_matrix_id, 'url' => ['view', 'id' => $model->transfer_money_matrix_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-money-matrix-update">

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
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
