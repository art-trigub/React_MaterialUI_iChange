<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PageRatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Ratings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-rating-index">

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

                            'page_rating_id',
            'url:url',
            'like_count',
            'dislike_count',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => [ 'width' => '140px' ]
                    ],
                ],
                ]); ?>
                                </div>
    </div>


</div>
