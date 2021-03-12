<?php

$this->params['breadcrumbs'][] = $model->label;
?>

<h1 class="container headline"><?= $model->title ?></h1>



<!-- about page -->
<div class="p-about container">
    <div class="p-about__img">
        <?php if($model->image): ?>
        <picture>
            <source media="(min-width: 640px)" srcset="<?= $model->imagePath ?>">
            <img src="<?= $model->previewPath ?>" alt="">
        </picture>
        <?php endif; ?>
        <div class="p-about__wrap">
            <p class="p-about__subtitle uk-visible@s"><?= $model->title ?></p>
            <div class="p-about__title">
                <?= $model->sub_title ?>
            </div>
        </div>
    </div>
    <div class="p-about__content" uk-grid="">
        <div class="uk-width-3-4@m">
            <div class="p-about__text">
                <?= $model->body ?>
            </div>
        </div>
        <div class="uk-width-1-4@m">
            <div class="support">
                <p class="support__title"><?= Yii::t('app', 'Call us') ?></p>
                <p class="support__subtitle"><?= Yii::t('app', 'Bank tech support') ?></p>
                <div class="support__wrap">
                    <div class="support__phone">
                        <a href="" class="support__link"><?= $this->params['contacts']->phone_1; ?></a>
                        <a href="" class="support__link"><?= $this->params['contacts']->phone_2; ?></a>
                    </div>
                    <a href="<?= $this->params['contacts']->whatsapp ?>" class="support__soc">
                        <svg class="icon" width="58" height="58">
                            <use xlink:href="#icon-w-app-color"></use>
                        </svg>
                        <span>Whatsapp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about page end -->