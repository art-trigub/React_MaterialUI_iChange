<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContentBlock */

$this->title = 'Update Content Block: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Content Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->content_block_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-block-update">

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
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
