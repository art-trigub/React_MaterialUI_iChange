<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CardOrder */

$this->title = $model->card_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Card Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card-order-view">

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
        <?= Html::a('Update', ['update', 'id' => $model->card_order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->card_order_id], [
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
            'card_order_id',
            'card_id',
            'customer_name',
            'customer_birthday',
            'country_id',
            'customer_email:email',
            'customer_phone',
            'comment:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

        </div>
    </div>
</div>

