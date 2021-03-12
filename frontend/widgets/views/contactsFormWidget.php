<?php

use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

?>
<div class="container">
    <div class="faq-form">
        <div class="faq-form__content">
            <div uk-grid="">
                <div class="uk-width-2-3@m">
                    <div class="form-cont">
                        <p class="form-cont__title"><?= Yii::t('app', 'Contact a bank') ?></p>
                            <?= Alert::widget() ?>

                            <?php
                            $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => ['class' => 'form-cont__form']
                            ]);
                            ?>
                            <div class="uk-child-width-1-2@s" uk-grid="">

                                <?= $form->field($model, 'email', [
                                ])->textInput(['placeholder' => 'E-mail'])->label(false) ?>

                                <?= $form->field($model, 'phone', [
                                ])->textInput(['placeholder' => 'Phone'])->label(false) ?>

                            </div>
                            <?= $form->field($model, 'phone', [
                            ])->textarea(['placeholder' => 'Body', 'class' => 'textarea'])->label(false) ?>

                            <button class="btn btn_green">Send</button>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="uk-width-1-3@m">
                    <div class="support">
                        <p class="support__title">Call us</p>
                        <p class="support__subtitle">Bank tech support</p>
                        <div class="support__wrap">
                            <div class="support__phone">
                                <a href="" class="support__link">687987327</a>
                                <a href="" class="support__link">687987327</a>
                            </div>
                            <a href="" class="support__soc">
                                <svg class="icon" width="58" height="58">
                                    <use xlink:href="#icon-w-app-color"></use>
                                </svg>
                                <span>Whatsapp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>