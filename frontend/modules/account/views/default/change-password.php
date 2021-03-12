<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\widgets\Alert;

$this->params['breadcrumbs'][] = Yii::t('app', 'change password');
?>

<!--<h1 class="container headline">--><?//= Yii::t('app', 'My Account') ?><!--</h1>-->

<!-- login page -->
<div class="container">

    <?= Alert::widget() ?>

    <div class="login">
        <div class="login__content">
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form form_login']
            ]);
            ?>
                <div class="form__block form__block_login">

                    <?= $form->field($model, 'oldPassword', ['size' => '4-6'])->passwordInput() ?>

                    <?= $form->field($model, 'newPassword', ['size' => '4-6'])->passwordInput() ?>

                </div>
                <div class="form__block">
                    <?= $form->field($model, 'newPasswordRepeat', ['size' => '4-6'])->passwordInput() ?>

                </div>
                <div class="form__grid">
                    <div class="form__grid-el form__grid-el_4-6 form__grid-el form__grid-el_4-6_login">
                        <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Change') ?></button>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- login page end -->
