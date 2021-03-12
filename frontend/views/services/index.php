<?php

use frontend\widgets\PageUseful;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

$this->title = $page->title;

$this->params['breadcrumbs'][] = $this->title;
?>


    <h1 class="container headline"><?= Yii::t('app', 'Services') ?></h1>

    <!-- news page -->
    <div class="container">
        <div class="news">
            <div class="news-el">
                <?= ListView::widget([
                    'layout' => "{items}",
                    'options' => ['tag' => 'ul', 'class' => '', 'uk-grid' => ''],
                    'itemOptions' => ['tag' => 'li', 'class' => 'uk-width-1-3@s uk-width-1-4@m'],
                    'dataProvider' => $dataProvider,
                    'itemView' => '_card',
                ]) ?>
            </div>
        </div>
    </div>
    <!-- news page end -->

    <!-- pagination -->
    <?= LinkPager::widget([
        'options' => ['class' => 'pagination uk-pagination uk-flex-center', 'uk-margin' => ''],
        'activePageCssClass' => 'uk-active',
        'pagination' => $dataProvider->getPagination()
    ]) ?>

    <!-- pagination end -->

    <!-- benefits -->
    <?= \frontend\widgets\Benefits::widget() ?>
    <!-- benefits end -->

    <div class="description container">
        <h2 class="description__title"><?= $page->title ?></h2>
        <div class="description__wrap">
            <?= $page->body ?>
        </div>
    </div>


<?= PageUseful::widget([
    'url' => '/services'
]) ?>