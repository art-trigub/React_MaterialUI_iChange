<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$this->title = 'Update Subscribe: ' . $model->subscribe_id;
$this->params['breadcrumbs'][] = ['label' => 'Subscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subscribe_id, 'url' => ['view', 'id' => $model->subscribe_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subscribe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
