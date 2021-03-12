<?php

use yii\helpers\Html;
use frontend\widgets\grid\GridView;
use frontend\widgets\Alert;
use common\models\Beneficiary;
use yii\helpers\Url;
?>

<div class="container pers-pg">
    <div uk-grid="">
        <div class="uk-width@m">
            <div class="wrapper-fm">
                <div class="wrapper-fm__wrap-title">
                    <p class="wrapper-fm__title"><?= Yii::t('app', 'Beneficiaries') ?></p>
                    <a href="<?= Url::to(['beneficiaries/create']) ?>" class="link link_green-ud-line"><?= Yii::t('app', 'Add new beneficiary') ?></a>
                </div>

                <div class="summary summary_col-6">
                    <?= Alert::widget() ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [

                            'fullName',
                            'countryName',
                            [
                                    'label' => Yii::t('app', 'Destination'),
                                    'value' => 'destinationCountry.name'
                            ],
                            [
                                'label' => '',
                                'value' => function($model) {
                                    return $model->type == Beneficiary::TYPE_BANK ? $model->bank_account_no : '';
                                }
                            ],
                            'type',
                            //'bank_name',
                            //'bank_account_no',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['class' => 'summary__td summary__td_links'],
                                'template' => "{send} {update} {delete}",
                                'buttons' => [
                                    'send' => function($url, $model, $key) {
                                        return Html::a('send', ['/account/money-transfers', 'TransferMoneyRequest' => ['beneficiary_id' => $model->beneficiary_id]], ['class' => 'btn btn_small']);
                                    },
                                    'update' => function($url, $model, $key) {
                                        $icon = '<svg class="icon" width="23" height="23">
                                                    <use xlink:href="#icon-pen"></use>
                                                </svg>';

                                        return Html::a($icon, ['update', 'id' => $model->beneficiary_id], ['class' => 'link link_pen-pale']);
                                    },
                                    'delete' => function($url, $model, $key) {
                                        $icon = '<svg class="icon" width="14" height="19">
                                                    <use xlink:href="#icon-basket"></use>
                                                </svg>';

                                        $options = [
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                            'class' => 'link link_basket-pale'
                                        ];

                                        return Html::a($icon, ['delete', 'id' => $model->beneficiary_id], $options);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
<!--        <div class="uk-width-1-3@m">-->
<!--            <div class="wrapper-fm wrapper-fm_sum">-->
<!--                <div uk-accordion="">-->
<!--                    <div class="uk-open">-->
<!--                        <p class="wrapper-fm__title wrapper-fm__title_sum uk-accordion-title arrow-up">Simulation</p>-->
<!--                        <div class="uk-accordion-content">-->
<!--                            <form class="form form_sum">-->
<!--                                <div class="form__grid">-->
<!--                                    <div class="form__grid-el form__grid-el_sum">-->
<!--                                        <div class="form__wrap-select">-->
<!--                                            <select class="form__select">-->
<!--                                                <option value="" disabled="" selected="">Select a country</option>-->
<!--                                                <option value="">Belarus</option>-->
<!--                                                <option value="">Israil</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="form__grid">-->
<!--                                    <div class="form__grid-el form__grid-el_sum">-->
<!--                                        <div class="form__wrap-select">-->
<!--                                            <select class="form__select">-->
<!--                                                <option value="" disabled="" selected="">Select a payout type</option>-->
<!--                                                <option value="">1</option>-->
<!--                                                <option value="">2</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="form__grid">-->
<!--                                    <div class="form__grid-el form__grid-el_sum">-->
<!--                                        <div class="form__wrap-select">-->
<!--                                            <select class="form__select">-->
<!--                                                <option value="" disabled="" selected="">Select an agent</option>-->
<!--                                                <option value="">agent 1</option>-->
<!--                                                <option value="">agent 2</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="form__grid">-->
<!--                                    <div class="form__grid-el form__grid-el_sum">-->
<!--                                        <div class="form-group">-->
<!--                                            <input type="text" class="input" placeholder="Fill amount to send in ILS">-->
<!--                                            <div class="help-block"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <button class="btn btn_green" type="button">Calculate</button>-->
<!--                            </form>-->
<!--                            <div class="wrapper-fm__subtext">-->
<!--                                <p class="wrapper-fm__text-s">Receive amount</p>-->
<!--                                <p class="wrapper-fm__text-b">50 000 INR</p>-->
<!--                            </div>-->
<!--                            <a href="#" class="btn wrapper-fm__link">Find location</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
    </div>
</div>