<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = 'Update Service: ' . $model->service_id;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->service_id, 'url' => ['view', 'id' => $model->service_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-update">

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
