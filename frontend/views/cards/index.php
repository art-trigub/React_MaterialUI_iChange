<?php

use \yii\widgets\Menu;
use yii\helpers\Url;
use common\models\Card;

$this->params['breadcrumbs'][] = Yii::t('app', 'cards');

?>

<div class="container headline">
    <p class="headline__title"><?= Yii::t('app', 'You can order a card here') ?></p>
</div>

<!-- card-filter -->
<div class="card-filter container">
    <?= Menu::widget([
        'options' => [
            'class' => 'card-filter__list'
        ],
        'itemOptions' => [
            'class' => 'link link_blue'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'All cards'),
                'url' => ['/cards/index'],
            ],
            [
                'label' => Yii::t('app', 'Debit cards'),
                'url' => ['/cards/debit'],
                'visible' => Card::find()->where(['type_id' => Card::TYPE_DEBIT])->exists()
            ],
            [
                'label' => Yii::t('app', 'Credit cards'),
                'url' => ['/cards/credit'],
                'visible' => Card::find()->where(['type_id' => Card::TYPE_CREDIT])->exists()
            ]
        ]
    ]) ?>
</div>
<!-- card-filter end -->

<div class="cards container">
    <?php foreach ($models as $model): ?>
        <div class="cards__el">
            <div class="cards__content uk-flex-middle">
                <?php if($model->image): ?>
                <div class="cards__img">
                    <img src="<?= $model->imagePath ?>" alt="">
                </div>
                <?php endif; ?>
                <div class="cards__wrap">
                    <div class="card-info__text-wrap">
                        <div class="card-info__wrap">
                            <p class="card-info__title"><?= $model->name ?></p>
                            <!--<div class="card-info__text">
                                <?= $model->short_description ?>
                            </div>-->
                        </div>
                    </div>
                    <!--<ul class="cards__list">
                        <?php foreach ($model->params as $param): ?>
                            <li class="cards__item"><?= $param->name ?></li>
                        <?php endforeach; ?>
                    </ul>-->
<!--                    <a href="--><?php // Url::to(['/cards/order', 'id' => $model->card_id, 'url' => $model->url]) ?><!--" class=" uk-margin-medium-bottom uk-display-block" >-->
<!--                        <span>--><?php // Yii::t('app', 'More Info') ?><!--</span>-->
<!--                        <svg class="icon" width="29" height="29">-->
<!--                            <use xlink:href="#icon-arrow-circle"></use>-->
<!--                        </svg>-->
<!--                    </a>-->
                    <a href="<?= Url::to(['/cards/order', 'id' => $model->card_id, 'url' => $model->url, '#' => 'order-form']) ?>" class="btn btn_blue">
                        <?= Yii::t('app', 'More Info') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
