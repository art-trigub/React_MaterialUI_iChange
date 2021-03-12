<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CurrencyOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Currency Orders';
$this->params['breadcrumbs'][] = $this->title;

$deleteLink = \yii\helpers\Url::to("delete-all");
$deleteSelectedScript = <<<JS
    $('#deleteSelected').on('click', function(e) {
        e.preventDefault();
        var keys = $(".grid-view").yiiGridView("getSelectedRows");
        
        $.post('$deleteLink', {id: keys }, function(){})
    })
JS;

$this->registerJs($deleteSelectedScript);

?>
<div class="currency-order-index">

    <?php
	// echo $this->render('_search', ['model' => $searchModel]); ?>

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
            <?= \yii\bootstrap4\Html::button('Delete Selected', [
                'class' => 'btn btn-danger mb-3',
                'data-confirm' => 'Are you sure you want to delete this item?',
                'data-method' => 'post',
                'id' => 'deleteSelected'
            ]) ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'currency_order_id',
                    'modifiedId',
                    'country.name',
                    'user_id',
                    'person_full_name',
                    'person_birthday_timestamp:datetime',
                    'person_passport_id',
                    'person_email:email',
                    'person_phone',
                    'amount',
                    'amount_ils',
                    'comment:ntext',
                    'rate',
//                    'acquisition_timestamp:datetime',
                    //'created_at',
                    //'updated_at',
                    //'status',
                    //'type',
                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
