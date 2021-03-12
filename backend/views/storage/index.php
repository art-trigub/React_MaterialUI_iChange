<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Storages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-index">

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

                    'storage_id',
                    'label',
                    'define',
                    'value',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'options' => ['width' => '140px'],
                        'buttons' => [
                            'delete' => function($url, $model, $key) {
                                if($model->is_protected) {
                                    return ;
                                }

                                $options = [
                                    'class' => 'btn btn-sm btn-danger',
                                    'title' => 'Delete',
                                    'data-pjax' => '0',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                ];
                                $icon = Html::tag('i', '', ['class' => "flaticon-delete"]);
                                return Html::a($icon, $url, $options);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
