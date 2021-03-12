<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyMatrix */

$this->title = $model->transfer_money_matrix_id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Money Matrices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transfer-money-matrix-view">

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
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->transfer_money_matrix_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->transfer_money_matrix_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'transfer_money_matrix_id',
            'country_id',
            'transfer_type_id',
            'transfer_agent_id',
            //'transfer_pickup_bank_id',
            'max_local_amount',
            'max_eur_amount',
            'max_usd_amount',
        ],
    ]) ?>
        </div>
    </div>
</div>
