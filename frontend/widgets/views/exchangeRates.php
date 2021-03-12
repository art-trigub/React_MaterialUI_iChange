<?php
use yii\helpers\Url;
?>
<div class="currency__exchange">
    <p class="currency__title"><?= Yii::t('app', 'Exchange rates') ?></p>
    <div class="currency__wrap">
        <p class="currency__text"><?= Yii::t('app', 'I-CHANGE rates') ?></p>
        <p class="currency__date"><time datetime="<?= Yii::$app->storage->get('currency_date:datetime') ?>"><?= Yii::$app->storage->get('currency_date:datetime') ?></time></p>
    </div>

    <div class="exchange">
        <div class="exchange__filter-by-sum">
            <div></div>
            <div>
                <p><?= Yii::t('app', 'Cash 0-500') ?></p>
            </div>
            <div>
                <p><?= Yii::t('app', 'Cash +500') ?></p>
            </div>
        </div>

        <table class="exchange__table">
            <thead class="exchange__thead">
            <tr class="exchange__tr">
                <th class="exchange__th"><?= Yii::t('app', 'Currency') ?></th>
                <th class="exchange__th"><?= Yii::t('app', 'Buy') ?></th>
                <th class="exchange__th"><?= Yii::t('app', 'Sell') ?></th>
                <th class="exchange__th"><?= Yii::t('app', 'Buy') ?></th>
                <th class="exchange__th"><?= Yii::t('app', 'Sell') ?></th>
            </tr>
            </thead>
            <tbody class="exchange__tbody">
            <?php foreach ($models as $model): ?>
                <tr class="exchange__tr">
                    <td class="exchange__td"><?= $model->name ?></td>
                    <td class="exchange__td"><?= $model->buy_1_result ?></td>
                    <td class="exchange__td"><?= $model->sell_1_result ?></td>
                    <?php if ($model->name != 'GBP'): ?>
                        <td class="exchange__td"><?= $model->buy_2_result ?></td>
                        <td class="exchange__td"><?= $model->sell_2_result ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= Url::to(['/currencies']) ?>" class="link link_white arrow-right"><?= Yii::t('app', 'All currencies') ?></a>
    </div>
</div>
