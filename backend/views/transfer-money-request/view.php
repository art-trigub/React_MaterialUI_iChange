<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyRequest */

$this->title = $model->transfer_money_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Money Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transfer-money-request-view">

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
                <?= Html::a('Update', ['update', 'id' => $model->transfer_money_request_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->transfer_money_request_id], [
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
                    'transfer_money_request_id',
                    'country.name',
                    'transferAgent.name',
                    'send_amount',
                    'receive_amount',
                    'sendCurrency.name',
                    'receiveCurrency.name',
                    'commission',
                    'total_amount',
                    'person_full_name',
                    'person_birthday_timestamp:date',
                    'person_passport_id',
                    'personCountry.name',
                    'person_email:email',
                    'person_phone',
                    'comment:ntext',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
