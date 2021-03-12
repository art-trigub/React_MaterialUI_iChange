<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\tree\Tree;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

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
            <div class="m-portlet__head-tools">
                <?= \backend\widgets\LangButtons::widget([
                    'btnGroupCssClass' => 'm-btn-group',
                    'model' => $model,
                    'action' => 'index',
                    'languages' => $langList
                ]) ?>
            </div>
        </div>
        <div class="m-portlet__body">
            <?= Tree::widget([
                'models' => $models,
                'sortClientOptions' => [
                    'stop' => new \yii\web\JsExpression('function(event, ui) {   
                    var self = $(this),           
                        sortElements = self.sortable("toArray");
                    $.get("/faq/category/sort", {
                        sortElements: sortElements
                    }, function(data) {
                        self.effect( "highlight", {}, 500 );
                    })
            }')
                ],
                'label' => function ($model) {
                    return $model->question;
                }
            ]); ?>
        </div>
    </div>


</div>
