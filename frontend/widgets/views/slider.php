<!-- main slider -->
<div class="m-slider container">

    <div class="m-slider__list uk-position-relative uk-visible-toggle" tabindex="-1" uk-slideshow="animation: push; max-height: 510; min-height: 440">

        <ul class="uk-slideshow-items">
            <?php foreach ($models as $model): ?>
            <?= Yii::$app->tmpl->render($model->template, $model) ?>
            <?php endforeach; ?>
        </ul>

        <div class="m-slider__nav">
            <a class="pointer pointer_left" href="#" uk-slideshow-item="previous"></a>
            <a class="pointer pointer_right" href="#" uk-slideshow-item="next"></a>
        </div>

        <ul class="m-slider__dotnav uk-slideshow-nav uk-dotnav"></ul>

    </div>
</div>
<!-- main slider end -->