<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<article class="news-el__item">
    <a href="<?= Url::to(['/services/view', 'id' => $model->service_id, 'url' => $model->url]) ?>">
        <div>
            <div class="news-el__img">
                <img data-src='<?=$model->previewPath?>' class="lazyload">
          </div>
            <div class="news-el__wrap">
                <h3 class="news-el__title"><?= $model->name ?></h3>
            </div>
        </div>
        <div class="news-el__wrap">
        </div>
    </a>
</article>