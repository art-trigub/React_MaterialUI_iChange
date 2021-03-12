<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
                <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
            'user_id',
            'github',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'first_name',
            'middle_name',
            'surname',
            'birthday',
            'gender',
            'passport_number',
            'passport_country_id',
            'passport_date_issue',
            'passport_date_expiry',
            'work_place',
            'work_name',
            'work_permit',
            'work_valid_until',
            'company_name',
            'address',
            'province',
            'zipcode',
            'country_id',
            'city',
            'phone',
            'phone_1',
            'status',
            'verified',
            'role',
            'created_at',
            'updated_at',
            'last_visit',
        ],
    ]) ?>
        </div>
    </div>
</div>
