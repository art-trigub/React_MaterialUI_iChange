<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransferCountryAgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfer Country Agents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-country-agent-index">

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
            <transfer-country-agent inline-template>
                <?php $i = 0; ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'transfer_country_agent_id',
                    [
						'attribute' => 'country_id',
						'filter' => ArrayHelper::map(Country::find()->all(), 'country_id', 'name'),
						'value' => 'country.name'
					],
//                    'country.name',
					[
						'label' => 'Name',
						'value' => 'agent.name'
					],
                    //'agent.name',
                    [
                        'attribute' => 'eur_course',
                        'value' => function($model) use (&$i) {
                            $i++;
                            return Html::beginForm('/transfer-country-agent/update?id=' . $model->transfer_country_agent_id, 'post', [
                                    '@submit' => 'changeCourse'
                                ]). Html::activeTextInput($model, 'eur_course', [
                                'class'   => 'form-control m-inputs',
                                'id'      => 'course-' . $i,
                                'style'   => 'width:80px',
                            ]) . Html::endForm();
                        },
                        'format' => 'raw'
                    ],

                    [
                        'attribute' => 'usd_course',
                        'value' => function($model) use (&$i) {
                            $i++;
                            return Html::beginForm('/transfer-country-agent/update?id=' . $model->transfer_country_agent_id, 'post', [
                                    '@submit' => 'changeCourse'
                                ]). Html::activeTextInput($model, 'usd_course', [
                                    'class'   => 'form-control m-input',
                                    'id' => 'course-' . $i,
                                    'style'   => 'width:80px',
                                ]) . Html::endForm();
                        },
                        'format' => 'raw'
                    ],

                    [
                        'class' => 'backend\widgets\grid\ActionColumn',
                        'options' => ['width' => '140px']
                    ],
                ],
            ]); ?>
            </transfer-country-agent>
        </div>
    </div>


</div>
