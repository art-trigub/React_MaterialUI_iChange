<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ContentBlock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Content Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-block-view">

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
                <?=  \backend\widgets\LangButtons::widget([
                    'btnGroupCssClass' => 'm-btn-group',
                    'action' => 'view',
                    'model' => $model,
                    'languages' => $langList
                ]) ?>
            </div>
        </div>
        <div class="m-portlet__body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->content_block_id], ['class' => 'btn btn-primary']) ?>
                <?= !$model->is_protected ? Html::a('Delete', ['delete', 'id' => $model->content_block_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) : "" ?>
            </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'content_block_id',
            'name',
        ],
    ]) ?>
        </div>
    </div>
</div>
