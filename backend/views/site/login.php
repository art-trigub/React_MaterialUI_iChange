<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;




$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-login__signin">
    <div class="m-login__head">
        <h3 class="m-login__title">Sign In To Admin</h3>

    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        //'enableAjaxValidation' => true,
        'options' => [
            'class' => 'm-login__form m-form'
        ]]); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>




    <div class="row m-login__form-sub">
        <div class="col m--align-left">
            <label class="m-checkbox m-checkbox--focus">
                <?php echo Html::activeCheckbox($model, 'rememberMe', [
                    'label' => false
                ]); ?> Remember me
                <span></span>
            </label>
        </div>
<!--        <div class="col m--align-right">-->
<!--            <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>-->
<!--        </div>-->
    </div>
    <div class="m-login__form-action">
        <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Sign In</button>
    </div>

    <?php ActiveForm::end(); ?>


</div>