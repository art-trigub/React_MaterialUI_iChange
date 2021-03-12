<?php

/* @var $personalFormModel \Frontend\models\PersonalDataForm */
/* @var $formModel \frontend\models\CardOrderForm */
/* @var $model */

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\Url;
use frontend\widgets\PersonalDataWidget;

$this->title = $model->name;

$this->params['breadcrumbs'][] = $model->name;


if($formModel->hasErrors() || $personalFormModel->hasErrors()) {
	$script = <<<JS
UIkit.modal('#order-form').show();
JS;

	$this->registerJs($script);
}

?>
<div class="headline container">
    <h1 class="headline__title"><?= Yii::t('app', 'Order') ?> <?= $model->name ?></h1>
</div>

<!-- card page -->
<div class="container">
    <div class="card-page">
		<?= Alert::widget() ?>

        <div class="card-info">
            <div class="uk-child-width-1-2@m" uk-grid="">
                <div>
                    <?php if($model->image): ?>
                        <div class="card-info__img">
                            <img src="<?= $model->imagePath ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="card-info__wrap">
                        <p class="card-info__title"><?= Yii::t('app', 'Order') ?> <?= $model->name ?></p>
                        <ul class="card-info__features">
                            <li class="card-info__el">
                                <p class="card-info__subtitle"><?= $model->regCostFormatted ?></p>
                                <p class="card-info__subtext"><?= Yii::t('app', 'Registration cost') ?></p>
                            </li>
                            <li class="card-info__el">
                                <p class="card-info__subtitle"><?= $model->atmCommissionFormatted ?></p>
                                <p class="card-info__subtext"><?= Yii::t('app', 'for ATM cash withdrawals') ?></p>
                            </li>
                            <li class="card-info__el">
                                <p class="card-info__subtitle"><?= $model->serviceCostFormatted ?></p>
                                <p class="card-info__subtext"><?= Yii::t('app', 'card service fee per year') ?></p>
                            </li>
                        </ul>
                        <div class="card-info__btn-wrap uk-visible@s">
                            <a href="#order-form" class="btn btn_green" uk-toggle><?= Yii::t('app', 'Order') ?></a>
                            <a href="#map" uk-scroll class="link link_blue">
                                <span><?= Yii::t('app', 'Office on map') ?></span>
                                <svg class="icon" width="12" height="14">
                                    <use xlink:href="#icon-pin"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-margin-medium">
				<?= $model->body ?>
            </div>
            <div class="uk-child-width-1-2@m" uk-grid="">
                <ul data-uk-accordion="multiple: true" class="card-info__text-wrap uk-margin-medium-bottom">
					<?php if($model->fees): ?>
                    <li class="card-info__wraps">
                        <a class="uk-accordion-title card-info__title" href="#"><?= Yii::t('app', 'Fees') ?></a>
                        <div class="uk-accordion-content">
							<?= $model->fees ?>

                        </div>
                    </li>
					<?php endif; ?>
                    <?php if($model->limitations): ?>
                    <li class="card-info__wraps">
                        <a class="uk-accordion-title card-info__title" href="#"><?= Yii::t('app', 'Limitations') ?></a>
                        <div class="uk-accordion-content">
							<?= $model->limitations ?>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="uk-flex uk-flex-bottom uk-flex-right">
                    <a href="<?= Url::to(['/cards']) ?>" class=" uk-margin-medium-bottom" >
                        <span><?= Yii::t('app', 'Go back') ?></span>
                        <svg class="icon" width="29" height="29">
                            <use xlink:href="#icon-arrow-circle"></use>
                        </svg>
                    </a>
                </div>


                <div>
                    <ul class="card-info__list">
                        <?php foreach ($model->params as $param): ?>
                            <li class="card-info__item"><?= $param->name ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="card-info__btn-wrap uk-hidden@s">
                        <a href="#order-form" class="btn btn_green" uk-toggle><?= Yii::t('app', 'Order') ?></a>
                        <a href="#" class="link link_blue">
                            <span><?= Yii::t('app', 'Office on map') ?></span>
                            <svg class="icon" width="12" height="14">
                                <use xlink:href="#icon-pin"></use>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div id="order-form" class="uk-flex-top uk-modal-container" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="card-form">
                    <p class="card-form__title"><?= Yii::t('app', 'Order form') ?></p>

							<?php $form = ActiveForm::begin([
								'id' => 'card-order-form',
								'options' => ['class' => 'form']
							]); ?>

                            <?= $form->errorSummary([$formModel, $personalFormModel]) ?>

							<?= PersonalDataWidget::widget([
								'form' => $form
							]) ?>

<!--                            <div class="form__block">-->
<!---->
<!--								--><?php //= $form->field($formModel, 'full_name', ['size' => '2-8'])->textInput() ?>
<!--								--><?php //// $form->field($formModel, 'first_name', ['size' => '2-8'])->textInput() ?>
<!---->
<!--								--><?php //// $form->field($formModel, 'last_name', ['size' => '2-8'])->textInput() ?>
<!---->
<!--								--><?php //= $form->field($formModel, 'birthday', ['size' => '2-8'])
//									->widget(frontend\widgets\DatePicker::className(), [
//										'layout' => '{input}{picker}',
//										'value' => '23.12.1982',
//										'pluginOptions' => [
//											'autoclose'=>true,
//											'format' => 'dd.mm.yyyy'
//										]
//									]) ?>
<!---->
<!--								--><?php //= $form->field($formModel, 'passport', ['size' => '2-8'])->textInput() ?>
<!---->
<!--                            </div>-->
<!--                            <div class="form__block">-->
<!---->
<!--								--><?php //= $form->field($formModel, 'country', ['size' => '2-8'])->textInput() ?>
<!---->
<!---->
<!--								--><?php //= $form->field($formModel, 'email', ['size' => '2-8'])->textInput() ?>
<!---->
<!--								--><?php //= $form->field($formModel, 'phone', ['size' => '2-8'])->textInput() ?>
<!--                            </div>-->


                            <!--                        <div class="form__block">-->
                            <!--                            --><?php //// $form->field($formModel, 'imageFiles[]', ['size' => '2-8'])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                            <!--                        </div>-->
                            <div class="form__block">
								<?= $form->field($formModel, 'agree', ['size' => '3-7'])
									->checkbox()
									->label(Yii::t('app', 'I agree to') . ' ' . Html::a(Yii::t('app', 'Terms of Use'), ['/terms-and-conditions'], ['target' => '_blank'])) ?>


                                <div class="form__grid">
                                    <div class="form__grid-el form__grid-el_3-7">
                                        <button class="btn btn_green" type="submit"><?= Yii::t('app', 'Send') ?></button>
                                    </div>
                                </div>
                            </div>
							<?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- card page end -->
