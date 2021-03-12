<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">

    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>
        <div class="login__content">
            <?php

            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-signup form form_login']
            ]);

            ?>

            <div class="form__block form__block_login">

                <?= $form->field($model, 'username', ['size' => '3-7'])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email', ['size' => '3-7'])->textInput() ?>

                <?= $form->field($model, 'password', ['size' => '3-7'])->passwordInput() ?>

            </div>
            <div class="form__grid">
                <div class="form__grid-el form__grid-el_3-7 form__grid-el form__grid-el_3-7_login">
                    <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Signup') ?></button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
