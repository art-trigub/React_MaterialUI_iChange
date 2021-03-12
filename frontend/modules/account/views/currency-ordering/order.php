<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use frontend\widgets\CurrencyCourse;
use common\widgets\Alert;
use common\models\Currency;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

?>

<h1 class="container headline"><?= Yii::t('app', 'Order') ?></h1>

<!-- order currency page -->
<div class="order container">
    <div class="order__content">
        <div uk-grid="">
            <div class="uk-width-2-3@m">
                <div class="order__form">
                    <p class="order__title"><?= Yii::t('app', 'Fill in a currency order form') ?></p>
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'ben-form',
                            'options' => ['class' => 'form form_order']
                        ]);
                        ?>

                        <?= $form->errorSummary($model) ?>

                        <div class="form__block form__block_order">


                            <?= $form->field($model, 'currency_id', ['size' => '3-7'])->widget(CurrencyCourse::className(), []) ?>



                            <!--                            <div class="form__grid">-->
<!--                                <div class="form__grid-el form__grid-el_3-7">-->
<!--                                    <div class="form__wrap-title">-->
<!--                                        <p class="form__title">Select currency</p>-->
<!--                                        <div class="form__currency uk-hidden@s">-->
<!--                                            <span>1 ILS</span>-->
<!--                                            <span> for </span>-->
<!--                                            <span>0,275014 USD</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="form__grid-el form__grid-el_3-7">-->
<!--                                    <div class="form-group form-group_flex">-->
<!--                                        <div class="form__wrap-select">-->
<!--                                            <select class="form__select">-->
<!--                                                <option value="">usd</option>-->
<!--                                                <option value="">Rub</option>-->
<!--                                                <option value="">eur</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                        <div class="form__currency uk-visible@s">-->
<!--                                            <span>1 ILS</span>-->
<!--                                            <span> for </span>-->
<!--                                            <span>0,275014 USD</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                            <?= $form->field($model, 'amount', ['size' => '3-7'])
                                ->textInput(['class' => 'input form-group__short form-control'])
                                ->label(Yii::t('app', 'What ammount would you require?')) ?>

                            <?= $form->field($model, 'acquisitionDateFormatted', [
                                'size' => '3-7',
                                'wrapperOptions' => ['class' => 'form-group form-group__short']
                            ])->widget(frontend\widgets\DatePicker::className(), [
                                    'layout' => '{input}{picker}',
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd.mm.yyyy'
                                    ]
                                ]) ?>
                        </div>

                        <div class="form__block">
                            <?= $form->field($model, 'first_name', ['size' => '3-7'])->textInput() ?>

                            <?= $form->field($model, 'last_name', ['size' => '3-7'])->textInput() ?>

                            <?= $form->field($model, 'passport_id', ['size' => '3-7'])->textInput() ?>

                            <?= $form->field($model, 'email', ['size' => '3-7'])->textInput() ?>

                            <?= $form->field($model, 'phone', ['size' => '3-7'])->textInput() ?>
                        </div>

                        <div class="form__block">

                            <?= $form->field($model, 'agree', ['size' => '3-7'])
                                ->checkbox()
                                ->label('I know the rulers and agree with terms of confidence') ?>

                            <div class="form__grid">
                                <div class="form__grid-el form__grid-el_3-7">
                                    <div class="form-group form__terms">
                                        <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Send documents') ?></button>
                                        <div class="form__text">
                                            <p>All currency exchange serivces in our office are provided according to license of Ministry of Finance | <a href="#">Terms of use</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="uk-width-1-3@m">
                <div class="order__benefits">
                    <ul class="order__list">
                        <li class="order__item">
                            <p class="order__subtitle">Order currency for your vacation today!</p>
                            <div class="order__text">
                                <p>Order currency in advance. Pay less and save money on comissions. Get your ordered currency in our office.</p>
                            </div>
                        </li>
                        <li class="order__item">
                            <p class="order__subtitle">Order currency and operations</p>
                            <div class="order__text">
                                <p>Orders for any currency except USD & EUR are held in system for 3 work days for fixed exchange rate on the moment of order. In case if order is left for longer time the exchange rate will be set on the moment of accquisition.
                                    The order is beeing paid upon receipt of currency.</p>
                            </div>
                        </li>
                        <li class="order__item">
                            <p class="order__subtitle">Installment for vacation!</p>
                            <div class="order__text">
                                <p>You can split the order ammount for several payments. Exchange rate is set for the the day of exchange. Now you can travel, have fun & do shopping with no further doubts. </p>
                            </div>
                        </li>
                        <li class="order__item">
                            <p class="order__subtitle">Service-centre</p>
                            <div class="order__text">
                                <p>08-8557300
                                    050-4207770</p>
                                <p>Municipal center, office 108,
                                    Ein Ha-Hatul str. Eilat, Israel</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- order currency end -->