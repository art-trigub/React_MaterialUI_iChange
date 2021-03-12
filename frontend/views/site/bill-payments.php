<?php

use yii\helpers\Url;


$this->title = Yii::t('app', 'Bill Payments');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="container headline"><?= Yii::t('app', 'You can pay your bills here') ?></h1>

<!-- bill-pay -->
<div class="container">
    <div class="bill-pay">
        <div class="bill-pay__content uk-child-width-1-2@s" uk-grid="">
            <div>
                <ul class="bill-pay__list">
                    <?php foreach ($models as $model): ?>
                        <li>
                            <a href="<?= Url::to($model->finalUrl) ?>" class="bill-pay__link"><?= $model->label ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <div class="bill-pay__info" uk-grid="">
                    <div class="uk-width-1-3">
                        <div class="bill-pay__img uk-visible@m">
                            <img src="/img/icon-time.svg" width="112" height="112" alt="">
                        </div>
                    </div>
                    <div class="uk-width-2-3@m">
                        <div class="bill-pay__wrap">
                            <p class="bill-pay__title">Payments with no need to wait</p>
                            <p class="bill-pay__text">Pay Express terminals for communal and other payments. No need to wait no documents to be filled!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bill-pay end -->