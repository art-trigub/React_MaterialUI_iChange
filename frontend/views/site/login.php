<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use frontend\widgets\ActiveForm;

use frontend\widgets\PageUseful;
use frontend\widgets\Benefits;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="headline container">
    <h1 class="headline__title"><?= Yii::t('app', 'My Account') ?></h1>
</div>
<!-- headline end -->

<!-- login page -->
<div class="login">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="login__content">
            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form form_login']
                ]);
            ?>

                <div class="form__block form__block_login">

                    <?= $form->field($model, 'email', ['size' => '3-7'])->textInput() ?>

                    <?= $form->field($model, 'password', ['size' => '3-7'])->passwordInput() ?>

                    <?php // $form->field($model, 'rememberMe', ['size' => '3-7'])->checkbox() ?>
                </div>
                <div class="form__grid">
                    <div class="form__grid-el form__grid-el_3-7 form__grid-el form__grid-el_3-7_login">
                        <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Log in') ?></button>
                        <?= Html::a(Yii::t('app', 'Forgot your password?'), ['/site/request-password-reset'], [
                            'class' => 'form__forg-pass'
                        ]) ?>
                        <?= Html::a(Yii::t('app', Yii::t('app', 'Create an account')), ['/site/signup'], [
                            'class' => 'btn btn_green'
                        ]) ?>

                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- login page end -->

<?= Benefits::widget() ?>

<?= PageUseful::widget() ?>

