<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CurrencyOrder */

$this->title = $model->currency_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Currency Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="currency-order-view">

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
                <?= Html::a('Update', ['update', 'id' => $model->currency_order_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->currency_order_id], [
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
            'currency_order_id',
            'currency.name',
            'user_id',
            'person_full_name',
            'person_birthday_timestamp:datetime',
            'person_passport_id',
            'country.name',
            'person_email:email',
            'person_phone',
            'amount',
            'amount_ils',
            'comment:ntext',
            'rate',
            'created_at:datetime',
            'updated_at:datetime',
            'status',
            'type',
        ],
    ]) ?>
        </div>
    </div>
</div>
