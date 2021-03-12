<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\Currency;
use common\models\Beneficiary;
use common\models\User;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\Url;


$this->params['breadcrumbs'][] = Yii::t('app', 'money transfer');

?>

<!-- personal page -->
<div class="container pers-pg">
    <money-transfer inline-template>
        <?php
        $form = ActiveForm::begin([
            'id' => 'transfer-money-form',
            'layout' => 'horizontal',
            'enableClientValidation'=>false,
            'options' => [
                'class' => '',
                '@submit' => "checkForm",
                'onsubmit'=> "return false",
                'ref' => 'moneyTransferForm'
            ]
        ]);
        ?>
        <?= Alert::widget() ?>

        <?= $form->errorSummary($model) ?>
<!--        <ul>-->
<!--            <li v-for="error in errors.collect()">{{ error }}</li>-->
<!--        </ul>-->
        <div uk-grid="">
            <div class="uk-width-3-5@m uk-width-2-3@l">
                <div class="wrapper-fm">
                    <p class="wrapper-fm__title wrapper-fm__title_border"><?= Yii::t('app', 'Send money online') ?></p>
                    <div class="form form_edit">

                        <?= $form->field($model, 'country_id', [
                                'options' => [
                                    'class' => 'form__grid form__grid_block required',
                                ]
                            ])
                            ->dropDownList(['{{country.name}}'], [
                                'prompt' => [
                                    'text' => Yii::t('app', 'Select country'),
                                    'options'=> ['disabled' => true, 'selected' => true]
                                ],
                                'v-model' => 'country_id',
                                'ref' => 'country',
                                'v-validate.disabled'=>"'required'",
                                '@change' => 'changeCountry',
                                'options' => [
                                    ['v-for' => "(country, id) in countryList", ":value"=>"country.country_id"]
                                ]
                            ])
                            //->label(' <div class="tooltip" uk-tooltip="title: Текст подсказки. Тут будет мини описание с подсказкой для клиента, если ему будет что-то не понятно. На пример, какой процент или как выбрать какой-то способ; pos: top-left"></div>')
//                            ->error([
//                                'encode' => false,
//                                'errorSource' => function($model) {
//                                    return "<span v-cloak>{{ errors.first('TransferMoneyRequest[country_id]') }}</span>";
//                                }
//                            ])
                        ?>


                        <?= $form->field($model, 'transfer_type_id', [
                                //'size' => '1-9',
                                'options' => ['class' => 'form__grid form__grid_block required']
                            ])
                            ->dropDownList([
                                '{{type.label}}'
                            ], [
                                'prompt' => [
                                    'text' => Yii::t('app', 'Select transfer type'),
                                    'options'=> ['disabled' => true, 'selected' => true, 'hidden' => true,]
                                ],
                                ':disabled' => 'countryLoading',
                                'v-validate.disabled'=>"'required'",
                                'v-model' => 'transfer_type_id',
                                '@change' => 'changeTransferType',
                                'options' => [
                                    ['v-for' => "(type, id) in transferTypeList", ":value"=>"type.transfer_type_id"]
                                ]
                            ])
                            //->label(' <div class="tooltip" uk-tooltip="title: Текст подсказки. Тут будет мини описание с подсказкой для клиента, если ему будет что-то не понятно. На пример, какой процент или как выбрать какой-то способ; pos: top-left"></div>') ?>



                            <?= $form->field($model, 'transfer_agent_id', [
                                //'size' => '1-9',
                                'options' => ['class' => 'form__grid form__grid_block required']
                            ])->widget(Select2::classname(), [
                                'data' => ['{{agent.label}}'],
                                'options' => [
                                    'prompt' => [
                                        'text' => Yii::t('app', 'Select an agenty'),
                                        'options'=> ['disabled' => true, 'selected' => true]
                                    ],
                                    ':disabled' => 'countryLoading || transferTypeLoading',
                                    'v-model' => 'transfer_agent_id',
                                    'v-validate.disabled'=>"'required'",
                                    'options' => [
                                        [
                                            'v-for' => "(agent, id) in transferAgentList",
                                            ":value"=>"agent.transfer_agent_id",
                                            ":data-image" => "agent.image"
                                        ]
                                    ]
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'templateResult' => $format = new JsExpression('function format(state) { 
                                        if(state.id) {
                                            let image = state.element.getAttribute("data-image");
                                            return image ? (\'<img style="width:40px" src="\' + image + \'"/>\' + state.text) : state.text;
                                        } else {
                                            return state.text;
                                        }
                                    }'),
                                    'templateSelection' => $format,
                                    'escapeMarkup' => new JsExpression("function(m) { return m; }"),
                                ],
                            ])//->label(' <div class="tooltip" uk-tooltip="title: Текст подсказки. Тут будет мини описание с подсказкой для клиента, если ему будет что-то не понятно. На пример, какой процент или как выбрать какой-то способ; pos: top-left"></div>');
                            ?>


                        <div class="form__grid form__grid_block" v-cloak>
                            <div class="form__grid-el">
                                <label class="control-label form__title ">

                                </label>
                            </div>
                            <div class="form__grid-el form__grid-sel">
                                <div class="form__inp-sel uk-flex uk-width-1-2@s">
                                    <div class="form-group uk-width-3-5">
                                        <?= Html::activeInput('number', $model, 'send_amount', [
                                            'class' => 'form-control',
                                            'v-validate' => "'required'",
                                            'v-model.number' => 'send_amount',
                                            'step'=> "0.01",
                                            '@input' => 'changeSendAmount'
                                        ]) ?>
                                    </div>

                                    <div class="form-group form__wrap-select uk-width-2-5">
                                        <?= Html::activeDropDownList($model, 'send_currency', ['{{currency.name}}'], [
                                            'ref'     => 'currency',
                                            'class'   => 'form-control form__select',
                                            'v-model' => 'send_currency',
                                            '@change' => 'changeSendCurrency',
                                            'v-validate.disabled'=>"'required'",
                                            'options' => [
                                                [
                                                    'v-for' => "(currency, key) in sendCurrencyList",
                                                    ':value' => 'currency.name'
                                                ]
                                            ]
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form__inp-sel uk-flex uk-width-1-2@s">
                                    <div class="form-group uk-width-3-5">
                                        <?= Html::activeInput('number', $model, 'receive_amount', [
                                            'class' => 'form-control',
                                            'step'=> "0.01",
                                            'v-model.number' => 'receive_amount',
                                            'v-validate' => "'maxReceiveAmount|required'",
                                            '@input' => 'changeReceiveAmount'
                                        ]) ?>
                                    </div>

                                    <div class="form-group form__wrap-select uk-width-2-5">
                                        <?= Html::activeDropDownList($model, 'receive_currency', ['{{currency.name}}'], [
                                            'ref'     => 'currency',
                                            'class'   => 'form-control form__select',
                                            'v-model' => 'receive_currency',
                                            '@change' => 'changeReceiveCurrency',
                                            'v-validate.disabled'=>"'required'",
                                            'options' => [
                                                [
                                                    'v-for' => "(currency, key) in receiveCurrencyList",
                                                    ':value' => 'currency.name'
                                                ]
                                            ]
                                        ]) ?>
                                    </div>
                                </div>

                                <div class="cross-course uk-width-1-1 uk-text-right">
                                  <span>{{ errors.first('TransferMoneyRequest[receive_amount]') }}</span>
                                </div>

                                <div class="cross-course uk-width-1-1 uk-text-center" v-if="transferCourse" v-cloak>
                                    1 {{send_currency}} = {{toFixed(transferCourse)}} {{receive_currency}}
                                </div>
                            </div>
                        </div>

                        <div uk-grid>
                            <div class=" uk-width-3-5@s uk-width-3-4@l">
                            <?= $form->field($model, 'beneficiary_id', [
                                'options' => [
                                    'class' => 'form__grid form__grid_block',
                                ]
                            ])->dropDownList(ArrayHelper::map(Beneficiary::find()->all(), 'beneficiary_id', 'fullName'), [
                                //'v-model' => 'beneficiary_id',
                                'rev' => 'beneficiary',
                                //'v-validate.disabled'=>"'required'",
                                '@change' => 'changeBeneficiary',
                                'prompt' => [
                                    'text' => Yii::t('app', 'Select beneficiary'),
                                    'options'=> ['disabled' => true, 'selected' => true]
                                ],
                            ]) ?>
                            </div>
                            <div class="uk-width-2-5@s uk-width-1-4@l uk-flex uk-flex-bottom">
                                <a target="_blank" class="btn btn_green" href="<?= Url::to(['/account/beneficiaries/create']) ?>"><?= Yii::t('app', 'Add new') ?></a>
                            </div>
                        </div>

                        <div class="form__grid form__grid_tooltip">
                            <div class="form__grid-el form__grid-el_1-9">
                            </div>
                            <div class="form__grid-el form__grid-el_1-9">
                                <div class="form__details">
                                    <p><?= Yii::t('app', 'Personal Details') ?>:</p>
                                    <p><?= Yii::$app->user->identity->fullName ?></p>
                                </div>
                            </div>
                        </div>
                        <div v-show="country_id && transfer_type_id && transfer_agent_id">


                            <div v-if="transferType.name=='BankDeposit'">

                                <?= $form->field($model, 'bank_name', [
                                    'options' => [
                                        'class' => 'form__grid form__grid form__grid_block required',
                                    ]
                                ])->textInput([
                                    'v-validate'=>"'required'"
                                ]) ?>

                                <?= $form->field($model, 'branch_name', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput([
                                    'v-validate'=>"'required'"
                                ]) ?>

                                <?= $form->field($model, 'add_bank', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput([
                                    'v-validate'=>"'required'"
                                ]) ?>

                                <?= $form->field($model, 'bank_code', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput([
                                    'v-validate'=>"'required'"
                                ]) ?>

                                <?= $form->field($model, 'account_number', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput([
                                    'v-validate'=>"'required'"
                                ]) ?>
                            </div>


                            <div v-if="transferType.name=='MobileDeposit'">

                                <?= $form->field($model, 'phone_number', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput();
                                ?>
                            </div>


                            <div v-if="transferType.name=='CashPickup'">

                            </div>


                            <div v-if="transferType.name=='CardDeposit'">

                                <?= $form->field($model, 'card_number', [
                                    'options' => [
                                        'class' => 'form__grid form__grid_block required'
                                    ]
                                ])->textInput();
                                ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'comment', [
                            'options' => [
                                'class' => 'form__grid form__grid_block required'
                            ]
                        ])->textarea([
                            'class' => 'form__textarea',
                            'placeholder' => Yii::t('app', 'Write a comment')
                        ])->label(false) ?>


                        <?= $form->field($model, 'agree', [
                            'options' => [
                                'class' => 'form__grid form__grid_block required'
                            ]

                        ])->checkbox([
                                'v-validate.disabled'=>"'required'",
                                'v-model' => 'agree'
                        ])->label('I know the rulers and agree with terms of confidence') ?>
                    </div>
                </div>
            </div>


            <div class="uk-width-2-5@m uk-width-1-3@l">
                <div class="mt-calc">
                    <div class="mt-calc__content">
                        <p class="mt-calc__title">
                            <span><?= Yii::t('app', 'Summary') ?></span>
                            <span v-cloak>{{send_currency}}</span>
                        </p>
                        <div class="mt-calc__wrap">
                            <p class="mt-calc__text">
                                <span><?= Yii::t('app', 'Send amount') ?></span>
                                <span v-cloak>{{send_amount}} {{send_currency}}</span>
                            </p>
                            <p class="mt-calc__text">
                                <span><?= Yii::t('app', 'Fee') ?> <span class="tooltip" uk-tooltip="title: Some text; pos: top"></span></span>
                                <span v-cloak="">+{{transferFeeConverted}} {{send_currency}}</span>
                                <?= Html::activeHiddenInput($model, 'commission', [
                                    ':value' => 'transferFeeConverted'
                                ]) ?>
                            </p>
                            <p class="mt-calc__text">
                                <span><?= Yii::t('app', 'Receive amount') ?></span>
                                <span v-cloak>{{receive_amount}} {{receive_currency}}</span>
                            </p>
                        </div>
                        <p class="mt-calc__title">
                            <span><?= Yii::t('app', 'Total to pay') ?></span>
                            <span v-cloak>{{toFixed(totalToPay)}} ILS</span>
                        </p>

                    </div>
<!--                    <button class="btn btn_green">Calculate</button>-->
                </div>
            </div>
        </div>

        <!-- benefits -->
        <div class="save-bk">
            <div class="container save-bk__wrap">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn_green']) ?>
                <?= Html::resetButton(Yii::t('app', 'Discard & exit'), ['class' => 'link link_blue-ud-line']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </money-transfer>
</div>
<!-- login page end -->



