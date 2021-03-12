<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

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

                    'news_id',
                    [
                        'format' => ['image', ['width'=>'100']],
                        'value'=>function($model) { return $model->previewPath; },
                    ],
                    'url:url',
                    'title',
                    'updated_at:datetime',
                    'created_at:datetime',
                    [
                        'label' => 'Is top',
                        'attribute' => 'is_top',
                        'filter' => [0 => 'Yes', 1 => 'No'],
                        'value' => function($model) {
                            return $model->is_top ? 'Yes' : 'No';
                        }
                    ],
                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
