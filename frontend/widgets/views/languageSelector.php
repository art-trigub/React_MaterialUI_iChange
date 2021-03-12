<?php

use yii\helpers\Url;


?>

<div class="header__lang lang">
    <button class="lang__btn active"><?= strtoupper(Yii::$app->language) ?></button>
    <div class="lang__popup" uk-dropdown="mode: click; offset: -30; pos: top-center; duration: 300">
        <?php foreach ($this->context->items as $item): ?>
        <a href="<?= Url::to($item['url']) ?>" class="lang__btn"><?= $item['label'] ?></a>
        <?php endforeach; ?>
    </div>
</div>