<?php

use common\models\Transaction;
use frontend\widgets\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;

?>

<!-- personal page navigation end -->

<?php
$gridColumns = [
    ['class' => 'frontend\widgets\grid\SerialColumn'],
    'created_at:datetime',
    'transaction_id',
    [
        'attribute' => 'beneficiaryName',
        'value' => 'beneficiary.fullName'
    ],
    [
        'attribute' => 'beneficiaryCountryName',
        'value' => 'beneficiary.CountryName'
    ],
    [
        'attribute' => 'beneficiaryType',
        'value' => 'beneficiary.typeText'
    ],
    'sent_amount',
    'received_amount',
    [
        'class' => 'frontend\widgets\grid\StatusColumn',
        'header' => Yii::t('app', 'Status'),
        'attribute' => 'status',
        'statusCssClass' => [
            Transaction::STATUS_CANCELED => 'canceled',
            Transaction::STATUS_FAILED   => 'failed',
            Transaction::STATUS_REQUEST  => 'request',
            Transaction::STATUS_SENT     => 'sent'
        ],
        'value' => function($model) {
            return $model->statusText;
        }
    ],
    ['class' => 'yii\grid\ActionColumn'],
];
?>

<div class="pers-headline container">
    <div class="pers-headline__wrap-title">
        <p class="pers-headline__title active"><a href="<?= Url::to(['/account/prepaid-card']) ?>"><?= Yii::t('app', 'Transactions') ?></a></p>
        <p class="pers-headline__title"><a href="#"><?= Yii::t('app', 'My cards') ?></a></p>
    </div>
    <div class="pers-headline__wrap uk-visible@m">

        <?= ExportMenu::widget([
            'asDropdown' => false,
            'exportConfig' => [
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                'Xlsx' => [
                    'label' => Yii::t('app', 'Save.exl'),
                    'alertMsg' => false,
                    'options' => ['tag' => false],
                    'linkOptions' => ['class' => 'link link_blue-ud-line pers-headline__link']
                ],
                'Pdf' => [
                    'label' => Yii::t('app', 'Save.PDF'),
                    'alertMsg' => false,
                    'options' => ['tag' => false],
                    'linkOptions' => ['class' => 'link link_blue-ud-line pers-headline__link']
                ]
            ],
            'showConfirmAlert' => false,
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]); ?>

    </div>
</div>

<!-- personal page -->
<div class="container pers-pg">
    <div class="wrapper-fm">
        <div class="summary summary_col-9">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
            ]); ?>

        </div>
    </div>
    <div class="pers-pg__wrap-links uk-hidden@m">

        <?= ExportMenu::widget([
            'asDropdown' => false,
            'exportConfig' => [
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                'Xlsx' => [
                    'label' => Yii::t('app', 'Download.xls'),
                    'alertMsg' => false,
                    'options' => ['tag' => false],
                    'linkOptions' => ['class' => 'link link_blue-ud-line']
                ],
                'Pdf' => [
                    'label' => Yii::t('app', 'Download.pdf'),
                    'alertMsg' => false,
                    'options' => ['tag' => false],
                    'linkOptions' => ['class' => 'link link_blue-ud-line']
                ]
            ],
            'showConfirmAlert' => false,
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]); ?>
    </div>
</div>
<!-- login page end -->
