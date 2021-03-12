<?php
use yii\helpers\Url;
?>
<!-- services -->
<section class="block container">
    <div class="block__wrap">
        <h2 class="block__title"><?= Yii::t('app', 'Popular services') ?></h2>
        <a href="<?= Url::to(['/services']) ?>" class="link link_blue arrow-right"><?= Yii::t('app', 'All services') ?></a>
    </div>
    <div class="service">
        <?php foreach ($models as $model): ?>
            <article class="service__item">
                <a class="service__wrap" href="<?= Url::to(['/services/view', 'id' => $model->service_id, 'url' => $model->url]) ?>">
                    <h3 class="service__title"><?= $model->name ?></h3>
                    <p class="service__text"><?= $model->sub_title ?></p>
                    <div class="service__hov">
                        <div class="pointer pointer_right"></div>
                    </div>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<!-- services end -->