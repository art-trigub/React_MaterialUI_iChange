<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">

    <div class="container">
        <p><?= Yii::t('app', 'Please choose your new password:') ?></p>

        <div class="login__content">
            <?php

            $form = ActiveForm::begin([
                'id' => 'reset-password-form',
                'options' => ['class' => 'form form_login']
            ]);

            ?>

            <div class="form__block form__block_login">

                <?= $form->field($model, 'password', ['size' => '3-7'])->passwordInput(['autofocus' => true]) ?>

            </div>
            <div class="form__grid">
                <div class="form__grid-el form__grid-el_3-7 form__grid-el form__grid-el_3-7_login">
                    <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Save') ?></button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
