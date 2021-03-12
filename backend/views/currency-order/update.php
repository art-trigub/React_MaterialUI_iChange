<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CurrencyOrder */

$this->title = 'Update Currency Order: ' . $model->currency_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Currency Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->currency_order_id, 'url' => ['view', 'id' => $model->currency_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currency-order-update">

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
