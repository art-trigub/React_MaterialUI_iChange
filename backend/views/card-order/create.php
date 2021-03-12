<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardOrder */
/* @var $cards common\models\Card */
/* @var $countries common\models\Country */

$this->title = 'Create Card Order';
$this->params['breadcrumbs'][] = ['label' => 'Card Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-order-create">

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

