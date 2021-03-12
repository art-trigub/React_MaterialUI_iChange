<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

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
                    [
                        'attribute' => 'card_id',
                        'options' => ['width' => '100px']
                    ],
                    [
                        'label' => 'Image',
                        'format' => ['image', ['width'=>'100']],
                        'options' => ['width' => '100px'],
                        'value'=>function($model) {
                            return $model->image ? $model->previewPath : false;
                        },
                    ],
                    [
                        'label' => 'Type',
                        'attribute' => 'type_id',
                        'filter' => $searchModel->getTypes(),
                        'value' => function($model) {
                            return $model->typeText;
                        }
                    ],
                    'name',
                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'template' => '{view} {update} {params} {delete}',
                        'buttons' => [
                            'params' => function($url, $model, $key) {
                                $icon = Html::tag('i', '', ['class' => "flaticon-shapes"]);
                                return Html::a($icon, $url, ['class' => 'btn btn-sm btn-default']);
                            }
                        ],
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
