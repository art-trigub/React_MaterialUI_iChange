<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<article class="news-el__item">
    <a href="<?= Url::to(['/news/view', 'id' => $model->news_id, 'url' => $model->url]) ?>">
        <div>
            <div class="news-el__img">
                <?= $model->image ? Html::img($model->previewPath) : '' ?>
            </div>
            <div class="news-el__wrap">
                <h3 class="news-el__title"><?= $model->name ?></h3>
            </div>
        </div>
        <div class="news-el__wrap">
            <p class="news-el__date">
                <time datetime="<?= $model->date ?>"><?= $model->date ?></time>
            </p>
        </div>
    </a>
</article>