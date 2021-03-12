<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Blacklist */

$this->title = 'Update Blacklist: '.$model->blacklist_id;
$this->params['breadcrumbs'][] = ['label' => 'Blacklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->blacklist_id, 'url' => ['view', 'id' => $model->blacklist_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blacklist-update">

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

    <?= $this->render('_form', [
		'model' => $model,
	]) ?>

        </div>
    </div>

</div>

