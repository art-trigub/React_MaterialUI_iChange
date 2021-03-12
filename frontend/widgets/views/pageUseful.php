<?php



?>

<!-- useful -->
<div class="container">
    <div class="useful">
        <div class="useful__content" uk-grid="">
            <div class="uk-width-1-4@m">
                <p class="useful__text"><?= Yii::t('app', 'Was this page useful?') ?></p>
            </div>
            <div class="uk-width-expand@m">
                <page-useful :disabled="<?= $this->context->disabled ? "true" : "false" ?>" url="<?= $this->context->url ?>"></page-useful>
            </div>
            <div class="uk-width-1-4@m">
                <copy-link url="<?= Yii::$app->request->absoluteUrl ?>"></copy-link>
            </div>
        </div>
    </div>
</div>
<!-- useful end -->

