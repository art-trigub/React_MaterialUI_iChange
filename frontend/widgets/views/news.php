<?php
    use yii\helpers\Url;
?>
<!-- news -->
<section class="block">
    <div class="block__wrap">
        <h2 class="block__title"><?= Yii::t('app', 'News') ?></h2>
        <a href="<?= Url::to(['/news']) ?>" class="link link_blue arrow-right"><?= Yii::t('app', 'All news') ?></a>
    </div>

    <div class="news-el" uk-slider="">

        <ul class="uk-slider-items uk-grid">
            <?php foreach ($models as $model): ?>
            <li class="uk-width-3-4 uk-width-2-5@s uk-width-1-4@m">
                <?= $this->render('@frontend/views/news/_card', ['model' => $model]) ?>
            </li>
            <?php endforeach; ?>
        </ul>


    </div>


</section>
<!-- news end -->