<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Currencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

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


                    'currency_id',
//                    'currency_icon_id',
//                    'icon:image',
                    'symbol',
                    [
                        'format' => ['image', ['width'=>'50']],
                        'value'=>function($model) { return $model->icon_path; },
                    ],
                    'name',
                    //'hint',
                    //'volume',
                    //'middle',
                    //'credit',
                    //'buy_1',
                    //'sell_1',
                    //'buy_2',
                    //'sell_2',
                    //'weight',
                    [
                        'format' => 'boolean',
                        'attribute' => 'for_order',
                        'filter' => [0=>'No',1=>'Yes'],
                    ],
                    [
                        'format' => 'boolean',
                        'attribute' => 'visible',
                        'filter' => [0=>'No',1=>'Yes'],
                    ],
                    //'visible',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
