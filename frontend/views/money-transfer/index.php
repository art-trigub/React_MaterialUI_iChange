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
use frontend\widgets\PersonalDataWidget;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\Url;


$this->params['breadcrumbs'][] = Yii::t('app', 'money transfer');

?>

<!-- personal page -->
<div class="container pers-pg">
    <?= Alert::widget() ?>

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

        <?= $form->errorSummary($model) ?>
        <!--        <ul>-->
        <!--            <li v-for="error in errors.collect()">{{ error }}</li>-->
        <!--        </ul>-->

        <div uk-grid="">
            <div class="uk-width-3-5@m uk-width-2-3@l">
                <div class="wrapper-fm">
                    <p class="wrapper-fm__title wrapper-fm__title_border"><?= Yii::t('app', 'Send money online') ?></p>
                    <div class="form form_edit">

                        <div v-show="firstStep">
                        <?= $form->field($model, 'country_id', [
                            'options' => [
                                'class' => 'form__grid form__grid_block required',
                            ]
                        ])
                            ->dropDownList(['{{country[1]}}'], [
                                'prompt' => [
                                    'text' => Yii::t('app', 'Select country'),
                                    'options'=> ['disabled' => true, 'selected' => true]
                                ],
                                'v-model' => 'country_id',
                                'ref' => 'country',
                                'v-validate.disabled'=>"'required'",
                                '@change' => 'changeCountry',
                                'options' => [
                                    ['v-for' => "(country, id) in sortedCountryList", ":value"=>"country[0]"]
                                ]
                            ])
                        ?>

                        <?= $form->field($model, 'transfer_type_id', [
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
                         ?>


                        <?= $form->field($model, 'transfer_agent_id', [
                            'options' => ['class' => 'form__grid form__grid_block required']
                        ])->widget(Select2::classname(), [

                            'data' => ['{{agent.label}}'],
                            'options' => [
                                'id' => 'transfer-agent',

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
                        ])
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
<!--                                <span v-if="errors" class="uk-text-danger uk-margin-small-top" v-for="item in errors.items">{{item.msg}}</span>-->


                                <div class="cross-course uk-width-1-1 uk-text-right uk-text-danger">
                                  <span>{{ errors.first('MoneyTransferForm[receive_amount]') }}</span>
                                </div>

                                <div class="cross-course uk-width-1-1 uk-text-center" v-if="transferCourse" v-cloak>
                                    1 {{send_currency}} = {{toFixed(transferCourse)}} {{receive_currency}}
                                </div>
                            </div>

                            <div class="uk-margin-top uk-margin-large-bottom">
                                <button type="button" class="btn btn_blue" @click="checkNextStep">Order</button>
<!--                                <button type="button" class="btn btn_blue" @click="firstStep = !firstStep">Order</button>-->
                            </div>
                        </div>

                        <div class="uk-hidden@m">
                            <div class="mt-calc mt-calc--mobile">
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
                                            <span><?=  Yii::t('app', 'Fee') ?>
                                                <span class="tooltip" data-uk-tooltip="title: <?=  Yii::t('app', 'Some text for hint') ?>; pos: top"></span>
                                            </span>
                                            <span v-cloak="">+{{transferFeeConverted}} {{send_currency}}</span>\
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
                            </div>
                        </div>

                        </div>

                        <div class="" v-show="!firstStep">
                            <?= PersonalDataWidget::widget([
                            	'form' => $form,
								'fieldSize' => '3-7',
								'fieldOptions' => [
									'email' => [
                                        'v-validate.disabled'=>"'required'",
									],
                                    'country_id' => [
                                        'v-validate.disabled'=>"'required'",
                                    ],
                                    'full_name' => [
                                        'v-validate.disabled'=>"'required'",
                                    ],
                                    'birthday_date' => [
                                        'v-validate.disabled'=>"'required'",
                                    ],
                                    'passport' => [
                                        'v-validate.disabled'=>"'required'",
                                    ],
                                    'phone_number' => [
                                        'v-validate.disabled'=>"'required'",
                                    ],
								]
							]) ?>
                            <div class="uk-width-1-1">
								<?= $form->field($model, 'agree', [
									'options' => [
										'class' => 'form__grid form__grid_block required'
									]

								])->checkbox([
									'v-validate.disabled'=>"'required'",
									'v-model' => 'agree'
								])->label(Yii::t('app', 'I agree to') . ' ' . Html::a(Yii::t('app', 'Terms of Use'), ['/terms-and-conditions'], ['target' => '_blank'])) ?>

                                <div class="uk-child-width-1-2@m uk-grid uk-margin-top uk-flex-middle" data-uk-grid>
                                    <div>
                                        <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn_green']) ?>
                                    </div>
                                    <div>
                                        <button type="button" class="link link_blue-ud-line uk-margin-auto-left" @click="firstStep = !firstStep">Go Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php /** $form->field($model, 'comment', [
                            'options' => [
                                'class' => 'form__grid form__grid_block required'
                            ]
                        ])->textarea([
                            'class' => 'form__textarea',
                            'placeholder' => Yii::t('app', 'Write a comment')
                        ])->label(false) */ ?>

                    </div>

                </div>

            </div>


            <div class="uk-width-2-5@m uk-width-1-3@l uk-visible@m">
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
                                <span><?=  Yii::t('app', 'Fee') ?>
                                    <span class="tooltip" data-uk-tooltip="title: <?=  Yii::t('app', 'Some text for hint') ?>; pos: top"></span>
                                </span>
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
                        <?= $form->field($model, 'send_amount')->hiddenInput(['v-model'=>'send_amount'])->label(false) ?>
                        <?= $form->field($model, 'send_currency')->hiddenInput(['v-model'=>'send_currency'])->label(false) ?>
                        <?= $form->field($model, 'receive_amount')->hiddenInput(['v-model'=>'receive_amount'])->label(false) ?>
                        <?= $form->field($model, 'receive_currency')->hiddenInput(['v-model'=>'receive_currency'])->label(false) ?>
                        <?= $form->field($model, 'fee')->hiddenInput(['v-model'=>'transferFeeConverted'])->label(false) ?>
                        <?= $form->field($model, 'course')->hiddenInput(['v-model'=>'transferCourse'])->label(false) ?>
                        <?= $form->field($model, 'cross_course_rate')->hiddenInput(['v-model'=>'crossCourseRate'])->label(false) ?>
                        <?= $form->field($model, 'total_to_pay')->hiddenInput(['v-model'=>'totalToPay'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </money-transfer>
</div>
<!-- login page end -->



