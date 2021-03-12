<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferMoneyMatrix */

$this->title = 'Commission';
$this->params['breadcrumbs'][] = 'Commission';
?>
<div class="transfer-money-matrix-update">

    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <?= Html::encode($this->title) ?> |
                        <?= $model->countryName . ' | ' . $model->transferTypeName . ' | ' . $model->transferAgentName ?>
                    </h3>
                </div>
            </div>


        </div>
        <div class="m-portlet__body">
            <transfer-money-commission :id="<?= Yii::$app->request->get('id') ?>"></transfer-money-commission>
        </div>
    </div>

</div>
