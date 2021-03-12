<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CardOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Card Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-order-index">

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'card_order_id',
            'card.name',
            'customer_name',
            'customer_birthday',
            'customer_id',
            'country.name',
            //'customer_email:email',
            //'customer_phone',
            //'comment:ntext',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'backend\widgets\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>


</div>
