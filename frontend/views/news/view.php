<?php

use yii\helpers\Url;

$this->title = $model->title;

$this->params['breadcrumbs'][] = $model->name;


?>

<h1 class="container headline"><?= $model->name ?></h1>

<!-- news page -->
<div class="container p-news">
    <div class="p-news__wrap-date">
        <time class="p-news__date" datetime="<?= $model->date ?>"><?= $model->date ?></time>
        <a href="<?= Url::to(['/news']) ?>" class="p-news__link"><?= Yii::t('app', 'Back to all news') ?></a>
    </div>
    <div uk-grid="">
        <div class="uk-width-3-4@m">
            <div class="p-news__content">
                <?php if($model->image): ?>
                <div class="p-news__img">
                    <img src="<?= $model->imagePath ?>" alt="">
                </div>
                <?php endif; ?>
                <div class="p-news__text">
                    <?= $model->body ?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4@m">
            <div class="p-news__wrap-title uk-hidden@m">
                <p class="p-news__title"><?= Yii::t('app', 'Related posts') ?></p>
                <a href="<?= Url::to(['/news']) ?>" class="link arrow-right"><?= Yii::t('app', 'All news') ?></a>
            </div>
            <div class="news-el" uk-slider="">
                <ul class="uk-slider-items uk-grid news-el__vert">
                    <?php foreach ($models as $model) : ?>
                    <li class="uk-width-3-4 uk-width-2-5@s uk-width-1-1@m">
                        <?php echo $this->render('_card', ['model' => $model]) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- news page end -->