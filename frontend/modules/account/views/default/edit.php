<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\User;

$this->params['breadcrumbs'][] = Yii::t('app', 'account edit');

$countries = ArrayHelper::map(Country::find()->all(), 'country_id', 'name');
?>
<!-- personal page -->
<div class="container pers-pg">
    <?= Alert::widget() ?>

    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => '']
    ]);
    ?>
    <?= $form->errorSummary($model) ?>
        <div uk-grid="">
        <div class="uk-width-5-12@l">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Personal details') ?></p>
                <div class="form form_edit">

                    <?= $form->field($model, 'first_name', ['size' => '4-6'])->textInput() ?>

                    <?= $form->field($model, 'middle_name', ['size' => '4-6'])->textInput() ?>

                    <?= $form->field($model, 'surname', ['size' => '4-6'])->textInput() ?>

                    <?= $form->field($model, 'birthdayDateFormatted', ['size' => '4-6'])
                        ->widget(frontend\widgets\DatePicker::className(), [
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                    ]) ?>
                    <?= $form->field($model, 'gender', ['size' => '4-6'])->dropDownList($model->getGenders()) ?>
                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Identification') ?></p>
                <div class="form form_edit">

                    <?= $form->field($model, 'passport_number', ['size' => '4-6'])->textInput() ?>

                    <?= $form->field($model, 'passport_country_id', ['size' => '4-6'])->dropDownList($countries) ?>

                    <?= $form->field($model, 'passportDateIssueFormatted', ['size' => '4-6'])
                        ->widget(frontend\widgets\DatePicker::className(), [
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                    ]) ?>

                    <?= $form->field($model, 'passportDateExpiryFormatted', ['size' => '4-6'])
                        ->widget(frontend\widgets\DatePicker::className(), [
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                    ]) ?>

                    <?= $form->field($model, 'imageFiles['.User::DOCS_TYPE_PASSPORT .'][]', ['size' => '4-6'])
                        ->fileInput(['multiple' => true])->label(Yii::t('app', 'Passport/ID')) ?>

                    <?= $form->field($model, 'imageFiles['.User::DOCS_TYPE_WORK .'][]', ['size' => '4-6'])
                        ->fileInput(['multiple' => true])->label(Yii::t('app', 'Working permit (Visa)')) ?>
                </div>
            </div>
        </div>
        <div class="uk-width-7-12@l">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Adresses') ?></p>
                <div class="uk-child-width-1-1@s" uk-grid="">
                    <div>
                        <div class="form form_edit">

                            <?= $form->field($model, 'address', ['size' => '4-6'])->textInput() ?>

                            <?= $form->field($model, 'city', ['size' => '4-6'])->textInput() ?>

                            <?= $form->field($model, 'zipcode', ['size' => '4-6'])->textInput() ?>

                            <?= $form->field($model, 'province', ['size' => '4-6'])->textInput() ?>

                            <?= $form->field($model, 'country_id', ['size' => '4-6'])->dropDownList($countries) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Contacts') ?></p>
                <div class="form form_edit">
                    <?= $form->field($model, 'phone', ['size' => 'edit-wide'])->textInput() ?>

                    <?= $form->field($model, 'phone_1', ['size' => 'edit-wide'])->textInput() ?>

                    <?= $form->field($model, 'email', ['size' => 'edit-wide'])->textInput() ?>

                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Place of work') ?></p>
                <div class="form form_edit">
                    <?= $form->field($model, 'work_place', ['size' => 'edit-wide'])->textInput() ?>

                    <?= $form->field($model, 'work_name', ['size' => 'edit-wide'])->textInput() ?>

                    <?= $form->field($model, 'work_permit', ['size' => 'edit-wide'])->dropDownList([
                        Yii::t('app', 'No'),
                        Yii::t('app', 'Yes')
                    ]) ?>

                    <?= $form->field($model, 'workValidUntilFormatted', ['size' => 'edit-wide'])
                        ->widget(frontend\widgets\DatePicker::className(), [
                            'layout' => '{input}{picker}',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
    <div class="save-bk">
        <div class="container save-bk__wrap">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn_green']) ?>
            <?= Html::resetButton(Yii::t('app', 'Discard & exit'), ['class' => 'link link_blue-ud-line']) ?>
        </div>
    </div>
<!--    <input type="submit" value="send"/>-->
    <?php ActiveForm::end(); ?>
</div>
<!-- login page end -->