<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset login">

    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('app', 'Please fill out your email. A link to reset password will be sent there.') ?></p>


        <div class="login__content">
            <?php

            $form = ActiveForm::begin([
                'id' => 'request-password-reset-form',
                'options' => ['class' => 'form form_login']
            ]);

            ?>

            <div class="form__block form__block_login">

                <?= $form->field($model, 'email', ['size' => '3-7'])->textInput() ?>

            </div>
            <div class="form__grid">
                <div class="form__grid-el form__grid-el_3-7 form__grid-el form__grid-el_3-7_login">
                    <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Send') ?></button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
