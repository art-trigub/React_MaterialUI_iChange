<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use frontend\widgets\CurrencyCourse;
use frontend\widgets\Alert;
use frontend\widgets\PersonalDataWidget;
use common\models\Currency;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\web\View;
use yii\helpers\Json;


$avDates = Json::encode($model->getAvailableDates());
$script = <<<JS
    function availableDate(date) {
        var availableDates = $avDates;
        var dmy = ('0' + date.getDate()).slice(-2) + "-" + (('0' + (date.getMonth()+1))).slice(-2) + "-" + date.getFullYear();
        if (availableDates.includes(dmy)) {
            return {'classes': 'highlighted'};
        } else {
            return false;
        }
    }
JS;

$this->registerJs($script, \backend\components\View::POS_HEAD);

?>

<h1 class="container headline"><?= Yii::t('app', 'Order') ?></h1>

<!-- order currency page -->
<div class="order container">
    <?= Alert::widget() ?>

    <div class="order__content">
        <div uk-grid="">


            <div class="uk-width-2-3@m">
                <div class="order__form">
                    <p class="order__title"><?= Yii::t('app', 'Fill in a currency order form') ?></p>
                    <currency-calc inline-template>
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'ben-form',
                        'options' => [
                            'class' => 'form form_order',
                            'onsubmit'=> "return false",
                            '@submit' => "checkForm",
                            'ref' => 'moneyTransferForm'
                        ]
                    ]);
                    ?>

                    <?= $form->errorSummary([$model, $personalModel]) ?>

                    <div class="form__block form__block_order">

                        <div>
                            <?= $form->field($model, 'currency_id', ['size' => '3-7'])->widget(CurrencyCourse::className(), [
                                'type' => CurrencyCourse::TYPE_CURRENCY,
                            ])->label(Yii::t('app', 'Select currency')) ?>
                            <?= $form->field($model, 'currencyCourse')->hiddenInput(['v-model'=>'CR_TO_ILS'])->label(false) ?>

                            <?= $form->field($model, 'amount', ['size' => '3-7'])->widget(CurrencyCourse::className(), [
                                'type' => CurrencyCourse::TYPE_AMOUNT,
                            ])->label(Yii::t('app', 'What amount would you require?')) ?>

                        </div>
                        <?= $form->field($model, 'acquisitionDateFormatted', [
                            'size' => '3-7',
                            'template' => "{beginLabelWrapper}\n{label}\n{endLabelWrapper}\n{beginFieldWrapper}\n{beginWrapper}\n<div><div class='position-relative'>{input}\n{error}</div></div>\n{endWrapper}\n{endFieldWrapper}\n{hint}",
                            'wrapperOptions' => ['class' => 'form-group uk-child-width-1-2@s', 'uk-grid' => '']
                        ])->widget(frontend\widgets\DatePicker::className(), [
                                'options' => [
                                    'autocomplete' => 'nope',
                                ],
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                    'beforeShowDay' => new JsExpression('function(dt) {
                                        return availableDate(dt);
                                    }'),
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy',
                                'daysOfWeekHighlighted' => ["16-10-2019"],
                                'todayHighlight' => true,
                            ]
                        ]) ?>
                        <?= $form->field($model, 'result_amount')->hiddenInput(['v-model'=>'amount[\'to\']'])->label(false) ?>
                    </div>

					<?= PersonalDataWidget::widget([
						'form' => $form
					]) ?>

                    <div class="form__block">
						<?= $form->field($model, 'agree', ['size' => '3-7'])
							->checkbox()
							->label(Yii::t('app', 'I agree to') . ' ' . Html::a(Yii::t('app', 'Terms of Use'), ['/terms-and-conditions'], ['target' => '_blank'])) ?>
<!--                        --><?php //$form->field($model, 'agree', ['size' => '3-7'])
//                            ->checkbox()
//							->label(Yii::t('app', 'Fill in a currency order form')) ?>

                        <div class="form__grid">
                            <div class="form__grid-el form__grid-el_3-7">
                                <div class="form-group form__terms">
                                    <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Send documents') ?></button>
                                    <div class="form__text">
                                        <p><?= Yii::t('app', 'All currency exchange services in our office are provided according to license of Ministry of Finance') ?> | <a href="#"><?= Yii::t('app', 'Terms of use') ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                    </currency-calc>
                </div>
            </div>
            <div class="uk-width-1-3@m">
                <div class="order__benefits">
                    <?= $page->body ?>
<!--                    <ul class="order__list">-->
<!--                        <li class="order__item">-->
<!--                            <p class="order__subtitle">Order currency for your vacation today!</p>-->
<!--                            <div class="order__text">-->
<!--                                <p>Order currency in advance. Pay less and save money on comissions. Get your ordered currency in our office.</p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="order__item">-->
<!--                            <p class="order__subtitle">Order currency and operations</p>-->
<!--                            <div class="order__text">-->
<!--                                <p>Orders for any currency except USD & EUR are held in system for 3 work days for fixed exchange rate on the moment of order. In case if order is left for longer time the exchange rate will be set on the moment of accquisition.-->
<!--                                    The order is beeing paid upon receipt of currency.</p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="order__item">-->
<!--                            <p class="order__subtitle">Installment for vacation!</p>-->
<!--                            <div class="order__text">-->
<!--                                <p>You can split the order ammount for several payments. Exchange rate is set for the the day of exchange. Now you can travel, have fun & do shopping with no further doubts. </p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="order__item">-->
<!--                            <p class="order__subtitle">Service-centre</p>-->
<!--                            <div class="order__text">-->
<!--                                <p>08-8557300-->
<!--                                    050-4207770</p>-->
<!--                                <p>Municipal center, office 108,-->
<!--                                    Ein Ha-Hatul str. Eilat, Israel</p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </ul>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- order currency end -->
