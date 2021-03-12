<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\Beneficiary;
use frontend\widgets\CountryPhoneWidget;
use yii\web\View;

$countryList = Country::find()->all();
$countries = ArrayHelper::map($countryList, 'country_id', 'name');

$countryData = ArrayHelper::index(ArrayHelper::toArray($countryList, [
    'common\models\Country' => [
        'country_id',
        'data-code' => function($model) {
            return $model->phone_code?:'';
        }
    ]
]), 'country_id');

?>

<?php
$form = ActiveForm::begin([
    'id' => 'ben-form',
    'options' => ['class' => '']
]);
?>
<!-- personal page -->
<div class="container pers-pg pers-pg_fst">
    <?= Alert::widget() ?>


    <?= $form->errorSummary($model) ?>
    <div uk-grid="">

        <div class="uk-width-1-2@m">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Personal details') ?></p>
                <div class="form">


                    <?= $form->field($model, 'first_name', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'middle_name', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'surname', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'birthdayDateFormatted', [
                        'size' => '3-7',
                        'wrapperOptions' => ['class' => 'form-group__short']
                        ])
                        ->widget(frontend\widgets\DatePicker::className(), [
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                    ]) ?>

                    <?= $form->field($model, 'gender', [
                        'size' => '3-7',
                        'wrapperOptions' => ['class' => 'form-group__short']
                    ])->dropDownList($model->getGenders()) ?>

                </div>
            </div>
        </div>
        <div class="uk-width-1-2@m">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Adresses') ?></p>
                <div class="form ">

                    <?= $form->field($model, 'address', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'city', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'zipcode', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'province', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'country_id', ['size' => '3-7'])->widget(CountryPhoneWidget::className(), [
                        'items' => $countries,
                        'itemsOptions' => $countryData,
                        'pointerFieldId' => Html::getInputId($model, 'phone')
                    ]) ?>
                    <?php // $form->field($model, 'country_id', ['size' => '3-7'])->dropDownList($countries) ?>

                    <?= $form->field($model, 'phone', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'phone_1', ['size' => '3-7'])->textInput() ?>

                </div>
            </div>
        </div>
        <!--
        <div class="uk-width-1-1">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Identification') ?></p>
                <div class="form form_horiz uk-width-5-6@l">
                    <div class="uk-child-width-1-2@m" uk-grid="">
                        <div>
                            <?= $form->field($model, 'passport_number', ['size' => '4-6'])->textInput() ?>
                        </div>
                        <div>
                            <?= $form->field($model, 'passport_country_id', ['size' => '4-6'])->dropDownList($countries) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-1">
            <div class="wrapper-fm wrapper-fm_tabs">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Send money by') ?></p>
                <div class="pers-nav pers-nav_tabs">
                    <button class="pers-nav__btn pers-nav__btn_tabs arrow-up" type="button"><?= Yii::t('app', 'Bank') ?></button>
                    <div class="pers-nav__content" uk-dropdown="mode: click; offset: -35; pos: bottom-center; flip:false">
                        <ul class="pers-nav__list pers-nav__list_tabs" uk-switcher="connect: #my-id; active: <?= array_search($model->type, [
                            Beneficiary::TYPE_BANK,
                            Beneficiary::TYPE_PICKUP,
                            Beneficiary::TYPE_CARD,
                            Beneficiary::TYPE_MOBILE])
                        ?>">
                            <li data-value="bank"><a href="#" class="pers-nav__link pers-nav__link_tabs"><?= Yii::t('app', 'Bank') ?></a></li>
                            <li data-value="pickup"><a href="#" class="pers-nav__link pers-nav__link_tabs"><?= Yii::t('app', 'Pick up') ?></a></li>
                            <li data-value="card"><a href="#" class="pers-nav__link pers-nav__link_tabs"><?= Yii::t('app', 'Card') ?></a></li>
                            <li data-value="mobile"><a href="#" class="pers-nav__link pers-nav__link_tabs"><?= Yii::t('app', 'Mobile') ?></a></li>
                        </ul>
                        <?= Html::activeHiddenInput($model, 'type', [
                            'class' => 'input-tab-value visually-hidden',
                            'value' => $model->type?: Beneficiary::TYPE_BANK
                        ]) ?>
                    </div>
                </div>

                <ul class="tabs-content uk-switcher" id="my-id">
                    <li uk-grid="">
                        <div class="uk-width-1-2@m uk-width-5-12@l">
                            <div class="form form_tabs">

                                <?= $form->field($model, 'bank_destination_id', ['size' => '4-6'])->dropDownList($countries) ?>

                                <?= $form->field($model, 'bank_name', ['size' => '4-6'])->textInput() ?>

                                <?= $form->field($model, 'bank_branch_name', ['size' => '4-6'])->textInput() ?>

                                <?php // $form->field($model, 'bank_add_bank', ['size' => '4-6'])->textInput() ?>

                                <?= $form->field($model, 'bank_code', ['size' => '4-6'])->textInput() ?>

                                <?= $form->field($model, 'bank_account_no', ['size' => '4-6'])->textInput() ?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <?= $form->field($model, 'pickup_destination_id', ['size' => '4-6'])->dropDownList($countries) ?>
                    </li>
                    <li>
                        <?= $form->field($model, 'card_destination_id', ['size' => '4-6'])->dropDownList($countries) ?>

                        <?= $form->field($model, 'card_number', ['size' => '4-6'])->textInput() ?>
                    </li>
                    <li>
                        <?= $form->field($model, 'mobile_destination_id', ['size' => '4-6'])->widget(CountryPhoneWidget::className(), [
                            'items' => $countries,
                            'itemsOptions' => $countryData,
                            'pointerFieldId' => Html::getInputId($model, 'mobile_number')
                        ]) ?>

                        <?= $form->field($model, 'mobile_number', ['size' => '4-6'])->textInput() ?>
                    </li>
                </ul>

            </div>
        </div> -->
    </div>

</div>

<!-- personal page end -->

<!-- benefits -->
<div class="save-bk">
    <div class="container save-bk__wrap">
        <button class="btn btn_green"><?= Yii::t('app', 'Save') ?></button>
<!--        <a href="#" class="link link_blue-ud-line">Discard & exit</a>-->
    </div>
</div>
<!-- benefits end -->

<?php ActiveForm::end(); ?>