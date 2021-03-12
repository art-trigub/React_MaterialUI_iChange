<?php

use frontend\widgets\PageUseful;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Faq');

$this->params['breadcrumbs'][] = $this->title;

?>

<h1 class="container headline"><?= Yii::t('app', 'FAQ') ?></h1>

<!-- faq page -->
<div class="container">
    <div class="faq-page">
        <div class="faq-page__el">

            <!-- faq list -->
            <div class="faq">
                <ul class="faq__list" uk-accordion="duration: 300">
                    <?php foreach ($questions as $key => $question): ?>
                    <li class="faq__item <?= $key == 0 ? 'uk-open' : ''?>">
                        <button class="uk-accordion-title faq__title triangle" href="#"><?= $question->question ?></button>
                        <div class="uk-accordion-content faq__text">
                            <p><?= $question->answer ?></p>
                        </div>
                    </li>
                   <?php endforeach; ?>
                </ul>
            </div>
            <!-- faq list end -->

        </div>
        <div class="faq-page__el">

            <!-- fast link -->
            <div class="fast-lk">
                <ul class="fast-lk__list">
                    <?php foreach ($categories as $category): ?>
                        <li <?= $category->faq_category_id == $categoryModel->faq_category_id ? 'class="active"' : '' ?>><a href="<?= Url::to(['/faq/category', 'id' => $category->faq_category_id, 'url' => $category->url]) ?>" class="fast-lk__link"><?= $category->label ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- fast link end -->

        </div>
    </div>
</div>
<!-- faq page end -->