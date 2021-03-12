<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransferPickupBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfer Pickup Banks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-pickup-bank-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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


                    'transfer_pickup_bank_id',
                    'name',
                    'label',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
