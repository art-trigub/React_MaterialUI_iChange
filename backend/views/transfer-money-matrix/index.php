<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\TransferType;
use common\models\TransferAgent;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransferMoneyMatrixSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfer Money Matrix';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-money-matrix-index">

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

                    'transfer_money_matrix_id',
                    [
                        'attribute' => 'country_id',
                        'filter' => ArrayHelper::map(Country::find()->all(), 'country_id', 'name'),
                        'value' => 'countryName'
                    ],
                    [
                        'attribute' => 'transfer_type_id',
                        'filter' => ArrayHelper::map(TransferType::find()->all(), 'transfer_type_id', 'label'),
                        'value' => 'transferTypeName'
                    ],
                    [
                        'attribute' => 'transfer_agent_id',
                        'filter' => ArrayHelper::map(TransferAgent::find()->all(), 'transfer_agent_id', 'label'),
                        'value' => 'transferAgentName'
                    ],
                    //'country_id',
                    //'transfer_type_id',
                    //'transfer_agent_id',
                    //'transfer_pickup_bank_id',
                    //'max_amount',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px'],
                        'template' => '{view} {update} {commission} {delete}',
                        'buttons' => [
                            'commission' => function($url, $model, $key) {
                                $icon = Html::tag('i', '', ['class' => "flaticon-shapes"]);
                                return Html::a($icon, $url, ['class' => 'btn btn-sm btn-default']);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
