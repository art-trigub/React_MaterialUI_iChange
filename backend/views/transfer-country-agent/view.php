<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransferCountryAgent */

$this->title = $model->transfer_country_agent_id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Country Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transfer-country-agent-view">

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
                <?= Html::a('Update', ['update', 'id' => $model->transfer_country_agent_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->transfer_country_agent_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'transfer_country_agent_id',
            'country_id',
            'transfer_agent_id',
            'eur_course',
            'usd_course',
        ],
    ]) ?>
        </div>
    </div>
</div>
