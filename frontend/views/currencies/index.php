<?php

use frontend\widgets\CrossRates;
use frontend\widgets\ExchangeRates;

?>

<!--<h1 class="container headline">--><?//= Yii::t('app', 'You can order a card here') ?><!--</h1>-->

<?= CrossRates::widget() ?>


<section class="block container">
    <div class="currency currency_page">
        <currency-converter class="currency__calc currency__calc_page"></currency-converter>
    </div>
</section>
