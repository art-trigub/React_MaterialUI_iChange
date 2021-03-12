<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\tree\Tree;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">


        <h1><?= Html::encode($this->title) ?></h1>

        <?= Tree::widget([
            'models' => $pages,
            'sortClientOptions' => [
                'stop' => new \yii\web\JsExpression('function(event, ui) {   
                    var self = $(this),           
                        sortElements = self.sortable("toArray");
                    $.get("/page/sort", {
                        sortElements: sortElements
                    }, function(data) {
                        self.effect( "highlight", {}, 500 );
                    })
            }')
            ],
            'label' => function($model) {
                return $model->label;
            }
        ]); ?>


</div>
