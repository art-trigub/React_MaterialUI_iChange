<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'user_id',
//                    'github',
//                    'auth_key',
//                    'password_hash',
//                    'password_reset_token',
                    'email:email',
                    'first_name',
                    'middle_name',
                    'surname',
                    'birthday:datetime',
                    'gender',
                    //'passport_number',
                    //'passport_country_id',
                    //'passport_date_issue',
                    //'passport_date_expiry',
                    //'work_place',
                    //'work_name',
                    //'work_permit',
                    //'work_valid_until',
                    //'company_name',
                    //'address',
                    //'province',
                    //'zipcode',
                    //'country_id',
                    //'city',
                    //'phone',
                    //'phone_1',
                    //'status',
                    //'verified',
                    'role',
                    //'created_at',
                    //'updated_at',
                    //'last_visit',

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [

                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
