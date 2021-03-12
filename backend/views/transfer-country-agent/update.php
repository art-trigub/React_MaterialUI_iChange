<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferCountryAgent */

$this->title = 'Update Transfer Country Agent: ' . $model->transfer_country_agent_id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Country Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transfer_country_agent_id, 'url' => ['view', 'id' => $model->transfer_country_agent_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-country-agent-update">

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
