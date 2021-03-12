<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferPickupBank */

$this->title = 'Create Transfer Pickup Bank';
$this->params['breadcrumbs'][] = ['label' => 'Transfer Pickup Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-pickup-bank-create">


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
