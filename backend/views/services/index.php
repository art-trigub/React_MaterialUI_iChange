<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

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
                    'name',
                    [
                        'label' => 'Image',
                        'format' => ['image', ['width' => '100']],
                        'options' => ['width' => '100px'],
                        'value' => function ($model) {
                            return $model->image ? $model->previewPath : false;
                        },
                    ],
                    'service_id',
                    'url:url',
                    [
                        'attribute' => 'is_popular',
                        'filter' => ['No', 'Yes'],
                        'value' => function($model) {
                            return ['No', 'Yes'][$model->is_popular];
                        }
                    ],
                    'updated_at:datetime',
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
