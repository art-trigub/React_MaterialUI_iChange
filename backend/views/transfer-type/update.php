<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransferType */

$this->title = 'Update Transfer Type: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->transfer_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-type-update">

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
                <?= \backend\widgets\LangButtons::widget(
					[
						'btnGroupCssClass' => 'm-btn-group',
						'model' => $model,
						'languages' => $langList
					]
				) ?>
            </div>
        </div>
        <div class="m-portlet__body">
            <?= $this->render(
				'_form',
				[
					'model' => $model,
				]
			) ?>
        </div>
    </div>

</div>
