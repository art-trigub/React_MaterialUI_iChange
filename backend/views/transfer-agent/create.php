<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferAgent */

$this->title = 'Create Transfer Agent';
$this->params['breadcrumbs'][] = ['label' => 'Transfer Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-agent-create">


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
