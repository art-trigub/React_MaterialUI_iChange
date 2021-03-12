<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContentBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Content Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-block-index">

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

                    'content_block_id',
                    'name',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'template' => '{view} {update} {chunks} {delete}',
                        'options' => ['width' => '140px'],
                        'buttons' => [
                            'chunks' => function($url, $model, $key) {
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
