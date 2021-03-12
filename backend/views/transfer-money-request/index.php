<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\metronic\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransferMoneyRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfer Money Requests';
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
<div class="transfer-money-request-index">

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
                [
					'class' => 'yii\grid\CheckboxColumn',
                    //'name' => 'transfer_money_request_id'
                ],
                'transfer_money_request_id',
                'country.name',
                'transferAgent.name',
                'send_amount',
                'receive_amount',
                'sendCurrency.name',
                'receiveCurrency.name',
                'commission',
                'total_amount',
                'person_full_name',
                'person_birthday_timestamp:date',
                'person_passport_id',
                'personCountry.name',
                'person_email:email',
                'person_phone',
                'comment:ntext',
                'created_at:datetime',

                [
                    'class' => 'backend\widgets\grid\ActionColumn',
                    'options' => ['width' => '140px']
                ],
            ],
        ]); ?>
        </div>
    </div>


</div>
