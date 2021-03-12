<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;
use account\AccountAsset;
use yii\helpers\ArrayHelper;

AccountAsset::register($this);



$this->params['breadcrumbs'] =  ArrayHelper::merge([
    'links' => [
        'label' => Yii::t('app', 'account'),
        'url' => ['/account']
    ]
], isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []);

?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
<div class="container">
    <?php
    $logout =  Html::beginForm(['/site/logout'], 'post', [
            'class' => 'userform'
        ])
        . Html::submitButton(Yii::t('app', 'Logout'), ['class' => 'btn btn_login'])
        . Html::endForm();
    echo $logout;
    ?>
</div>

<div class="headline container">

    <h1 class="headline__title">
        <?= Yii::t('app', 'Hello') ?>, <?= Yii::$app->user->identity->fullName ?>
    </h1>
    <div class="headline__hist">
        <p class="headline__user"><?= Yii::t('app', 'User Id') ?>: <span><?= Yii::$app->user->id ?></span></p>
        <p class="headline__date"><?= Yii::t('app', 'Last entrance at') ?> - <time datetime="<?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->last_visit) ?>"><?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->last_visit) ?></time></p>
    </div>
</div>

<!-- personal page navigation -->
<div class="container pers-nav">
    <button class="pers-nav__btn arrow-up " type="button"><?= Yii::t('app', 'Personal details') ?></button>
    <div class="pers-nav__content" uk-dropdown="mode: click; offset: -35; pos: bottom-center; flip:false">
        <?= Menu::widget([
            'options' => ['class' => 'pers-nav__list'],
            'items' => [
                [
                    'label' => Yii::t('app', 'Personal details'),
                    'url' => ['/account'],
                    'active' => $this->context->id == 'default'
                ],
                [
                    'label' => Yii::t('app', 'Money Transfers'),
                    'url' => ['/account/money-transfers'],
                    'active' => $this->context->id == 'money-transfers'
                ],
                [
                    'label' => Yii::t('app', 'Beneficiaries'),
                    'url' => ['/account/beneficiaries'],
                    'active' => $this->context->id == 'beneficiaries'
                ],
                [
                    'label' => Yii::t('app', 'Pre-paid Card'),
                    'url' => ['/account/prepaid-card'],
                    'active' => $this->context->id == 'prepaid-card'
                ],
                [
                    'label' => Yii::t('app', 'Currency ordering'),
                    'url' => ['/account/currency-ordering'],
                    'active' => $this->context->id == 'currency-ordering'
                ],
                [
                    'label' => Yii::t('app', 'Contact us'),
                    'url' => ['/account/contact-us'],
                    'active' => $this->context->id == 'contact-us'
                ],
            ]
        ]) ?>
    </div>
</div>

<?= $content ?>

<?php $this->endContent() ?>
