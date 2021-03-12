<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscribes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-index">

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
            <?php
            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],
                'subscribe_id',
                'email:email',
                [
                    'class' => 'backend\widgets\grid\ActionColumn',
                    'options' => ['width' => '140px']
                ],
            ];
            ?>
            <div style="margin-bottom:20px;">
                <?= ExportMenu::widget([
                    'showConfirmAlert' => false,
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns
                ]); ?>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
            ]); ?>
        </div>
    </div>
</div>
</div>
