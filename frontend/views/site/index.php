<?php

use frontend\widgets\ContentBlock;
use frontend\widgets\CrossRates;
use frontend\widgets\PageUseful;
use frontend\widgets\News;
use frontend\widgets\Banner;
use frontend\widgets\Slider;
use frontend\widgets\ExchangeRates;
use frontend\widgets\PopularServices;
use yii\helpers\Url;
use frontend\widgets\DatePicker;
/* @var $this yii\web\View */

$this->title = 'I-Change';
?>
<div class="site-index">

    <?php

//    echo 'Birth Date';
//    echo DatePicker::widget([
//        'name' => 'dp_1',
//        'layout' => '{input}{picker}',
//        'value' => '23-Feb-1982',
//        'pluginOptions' => [
//            'autoclose'=>true,
//            'format' => 'dd-M-yyyy'
//        ]
//    ]);
    ?>

    <?= Slider::widget() ?>

    <?= Banner::widget([
        'name' => 'intro'
    ]) ?>

    <?= PopularServices::widget() ?>

<!--    services-->

    <?= Banner::widget([
        'name' => 'main'
    ]) ?>

    <?php // CrossRates::widget() ?>

    <div class="container">
        <section class="block">
            <div class="block__wrap">
                <h2 class="block__title"><?= Yii::t('app', 'Finance') ?></h2>
            </div>
            <div class="currency">
                <currency-converter></currency-converter>
                <?= ExchangeRates::widget() ?>
            </div>
        </section>
    </div>

    <div class="container">
        <?= News::widget() ?>
    </div>

    <!-- about -->
    <div class="container">
        <section class="block">
            <div class="block__wrap">
                <h2 class="block__title"><?= Yii::t('app', 'About') ?></h2>
                <a href="<?= Url::to([$about->url]) ?>" class="link link_blue arrow-right"><?= Yii::t('app', 'More') ?></a>
            </div>

            <div class="about">
                <div class="about__wrap">
                    <div>
                        <h3 class="about__title"><?= $about->sub_title ?></h3>
                        <p class="about__text"><?= $about->description ?></p>
                    </div>
                </div>

                <div class="about__work-done">
                    <div>
                        <div class="work-done">
                            <div class="work-done__section">
                                <p class="work-done__b-num"><?= Yii::$app->storage->get('transfers_done', 0) ?></p>
                                <p class="work-done__title"><?= Yii::t('app', 'That many transfers we’ve done in') ?> <?= date('Y') ?></p>
                            </div>
                            <div class="work-done__section">
                                <div class="work-done__wrap">
                                    <p class="work-done__num"><?= Yii::$app->storage->get('service_counter', 0) ?></p>
                                    <p class="work-done__text"><?= Yii::$app->storage->get('service_counter', 0) ?> <?= Yii::t('app', 'years of perfect service') ?></p>
                                </div>
                                <div class="work-done__wrap">
                                    <p class="work-done__num"><?= Yii::$app->storage->get('transfer_options', 0) ?></p>
                                    <p class="work-done__text"><?= Yii::t('app', 'options for money transfer') ?></p>
                                </div>
                                <div class="work-done__wrap">
                                    <p class="work-done__num"><?= Yii::$app->storage->get('transfers_countries', 0) ?></p>
                                    <p class="work-done__text">
                                        <?= Yii::t('app',
                                            'transfers to 
                                        {n,plural,=0{# country} 
                                        =1{# country} 
                                        one{# country} 
                                        few{# country} 
                                        many{# countries} 
                                        other{# countries}}!', ['n' => Yii::$app->storage->get('transfers_countries', 0)]) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- about end -->


<!--    --><?php //PageUseful::widget([
//        'url' => '/site/index'
//    ]) ?>



</div>
