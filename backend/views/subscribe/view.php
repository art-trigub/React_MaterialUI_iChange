<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$this->title = $model->subscribe_id;
$this->params['breadcrumbs'][] = ['label' => 'Subscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subscribe-view">
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subscribe_id',
            'email:email',
        ],
    ]) ?>

    </div>
</div>
</div>


</div>
