<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardOrder */
/* @var $cards common\models\Card */
/* @var $countries common\models\Country */

$this->title = 'Update Card Order: ' . $model->card_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Card Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->card_order_id, 'url' => ['view', 'id' => $model->card_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card-order-update">

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
				'cards' => $cards,
				'countries' => $countries
			]) ?>
        </div>
    </div>

</div>

