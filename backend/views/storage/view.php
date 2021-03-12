<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Storage */

$this->title = $model->storage_id;
$this->params['breadcrumbs'][] = ['label' => 'Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="storage-view">

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
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->storage_id], ['class' => 'btn btn-primary']) ?>
                <?= !$model->is_protected ? Html::a('Delete', ['delete', 'id' => $model->storage_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])  : '' ?>
            </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'storage_id',
            'label',
            'define',
            'value',
        ],
    ]) ?>
        </div>
    </div>
</div>
