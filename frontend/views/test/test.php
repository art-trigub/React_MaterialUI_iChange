<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

?>
<div class="m-portlet__body">
    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'subscribe_id',
        'email:email',
        ['class' => 'yii\grid\ActionColumn'],
    ];
    ?>
    <div style="margin-bottom:20px;">
        <?= ExportMenu::widget([
            'asDropdown' => false,
            'exportConfig' => [

            ],
            'showConfirmAlert' => false,
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]); ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
</div>
</div>