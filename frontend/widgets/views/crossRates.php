<?php


?>

<div class="container">
    <div class="rates-page">

        <div class="rates-page__wrap">
            <p class="rates-page__title"><?= Yii::t('app', 'Currency exchange rates at i-change') ?></p>
            <p class="rates-page__text"><?= Yii::t('app', 'Exchange rates for') ?> <time datetime="<?= Yii::$app->storage->get('currency_date:datetime') ?>"><?= Yii::$app->storage->get('currency_date:datetime') ?></time></p>
        </div>

        <div class="rates rates_top">
            <div uk-grid="">
                <div class="uk-grid-el">
                    <div class="rates__item rates__item_fst">
                        <p class="rates__title"><?= Yii::t('app', 'Cash 0-500') ?></p>
                        <table class="rates__table">
                            <thead class="rates__thead">
                            <tr class="rates__tr">
                                <th class="rates__th rates__th_flag"></th>
                                <th class="rates__th rates__th_title"></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Buy') ?></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Sell') ?></th>
                                <th class="rates__th rates__th_num uk-visible@l"></th>
                            </tr>
                            </thead>
                            <tbody class="rates__tbody">
                            <?php foreach ($models as $key => $model): if($key > 1) break; ?>
                                <tr class="rates__tr rates__tr_body">
                                    <td class="rates__td rates__td_flag">
                                        <div class="rates__flag">
                                            <img src="<?= $model->icon_path ?>" alt="">
                                        </div>
                                        <div class="uk-hidden@l">
                                            <p><?= $model->name ?></p>
                                        </div>
                                    </td>
                                    <td class="rates__td rates__td_title">
                                        <p><?= $model->name ?></p>
                                    </td>
                                    <td class="rates__td rates__td_num"><?= $model->buy_1_result ?></td>
                                    <td class="rates__td rates__td_num"><?= $model->sell_1_result ?></td>
                                    <td class="rates__td rates__td_num uk-visible@l"></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="uk-grid-el">
                    <div class="rates__item rates__item_top rates__item_snd">
                        <p class="rates__title"><?= Yii::t('app', 'Cash +500') ?></p>
                        <table class="rates__table">
                            <thead class="rates__thead">
                            <tr class="rates__tr">
                                <th class="rates__th rates__th_flag uk-hidden@m"></th>
                                <th class="rates__th rates__th_title uk-hidden@m"></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Buy') ?></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Sell') ?></th>
                                <th class="rates__th rates__th_num uk-visible@l"></th>
                            </tr>
                            </thead>
                            <tbody class="rates__tbody">
                            <?php foreach ($models as $key => $model): if($key > 1) break; ?>
                                <tr class="rates__tr rates__tr_body">
                                    <td class="rates__td rates__td_flag uk-hidden@m">
                                        <div class="rates__flag">
                                            <img src="<?= $model->icon_path ?>" alt="">
                                        </div>
                                        <div>
                                            <p><?= $model->name ?></p>
                                        </div>
                                    </td>
                                    <td class="rates__td rates__td_title uk-hidden@m"></td>
                                    <td class="rates__td rates__td_num"><?= $model->buy_2_result ?></td>
                                    <td class="rates__td rates__td_num"><?= $model->sell_2_result ?></td>
                                    <td class="rates__td rates__td_num uk-visible@l"></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="uk-grid-el uk-visible@m">
                    <div class="rates__item rates__item_top rates__item_trd">
                        <p class="rates__title"><?= Yii::t('app', 'Debit') ?></p>
                        <table class="rates__table">
                            <thead class="rates__thead">
                            <tr class="rates__tr">
                                <th class="rates__th rates__th_flag uk-hidden@m"></th>
                                <th class="rates__th rates__th_title uk-hidden@m"></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Debit') ?></th>
                                <th class="rates__th rates__th_num uk-visible@l"></th>
                            </tr>
                            </thead>
                            <tbody class="rates__tbody">
                            <?php foreach ($models as $key => $model): if($key > 1) break; ?>
                                <tr class="rates__tr rates__tr_body">
                                    <td class="rates__td rates__td_flag uk-hidden@m">
                                        <div class="rates__flag">
                                            <img src="<?= $model->icon_path ?>" alt="">
                                        </div>
                                        <div>
                                            <p><?= $model->name ?></p>
                                        </div>
                                    </td>
                                    <td class="rates__td rates__td_title uk-hidden@m"></td>
                                    <td class="rates__td rates__td_num"><?= $model->debit_result ?></td>
                                    <td class="rates__td rates__td_num uk-visible@l"></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="uk-grid-el uk-visible@m">
                    <div class="rates__item rates__item_top rates__item_trd">
                        <p class="rates__title"><?= Yii::t('app', 'Credit') ?></p>
                        <table class="rates__table">
                            <thead class="rates__thead">
                            <tr class="rates__tr">
                                <th class="rates__th rates__th_flag uk-hidden@m"></th>
                                <th class="rates__th rates__th_title uk-hidden@m"></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Credit') ?></th>
                                <th class="rates__th rates__th_num uk-visible@l"></th>
                            </tr>
                            </thead>
                            <tbody class="rates__tbody">
                            <?php foreach ($models as $key => $model): if($key > 1) break; ?>
                                <tr class="rates__tr rates__tr_body">
                                    <td class="rates__td rates__td_flag uk-hidden@m">
                                        <div class="rates__flag">
                                            <img src="<?= $model->icon_path ?>" alt="">
                                        </div>
                                        <div>
                                            <p><?= $model->name ?></p>
                                        </div>
                                    </td>
                                    <td class="rates__td rates__td_title uk-hidden@m"></td>
                                    <td class="rates__td rates__td_num"><?= $model->credit_result ?></td>
                                    <td class="rates__td rates__td_num uk-visible@l"></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="uk-grid-el uk-visible@m">
                    <div class="rates__item rates__item_top rates__item_trd">
                        <p class="rates__title"><?= Yii::t('app', 'Middle') ?></p>
                        <table class="rates__table">
                            <thead class="rates__thead">
                            <tr class="rates__tr">
                                <th class="rates__th rates__th_flag uk-hidden@m"></th>
                                <th class="rates__th rates__th_title uk-hidden@m"></th>
                                <th class="rates__th rates__th_num"><?= Yii::t('app', 'Middle') ?></th>
                                <th class="rates__th rates__th_num uk-visible@l"></th>
                            </tr>
                            </thead>
                            <tbody class="rates__tbody">
                            <?php foreach ($models as $key => $model): if($key > 1) break; ?>
                                <tr class="rates__tr rates__tr_body">
                                    <td class="rates__td rates__td_flag uk-hidden@m">
                                        <div class="rates__flag">
                                            <img src="<?= $model->icon_path ?>" alt="">
                                        </div>
                                        <div>
                                            <p><?= $model->name ?></p>
                                        </div>
                                    </td>
                                    <td class="rates__td rates__td_title uk-hidden@m"></td>
                                    <td class="rates__td rates__td_num"><?= $model->middle ?></td>
                                    <td class="rates__td rates__td_num uk-visible@l"></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="rates rates--bottom">
            <div class="rates__item">
                <table class="rates__table">
                    <thead class="rates__thead" style="z-index: 980; background-color: white; padding-top: 20px" uk-sticky="bottom: #end_sticky">
                    <tr class="rates__tr">
                        <th class="rates__th rates__th_flag"><p class="uk-visible@s"><?= Yii::t('app', 'Currency code') ?></p></th>
                        <th class="rates__th rates__th_title"></th>
                        <th class="rates__th rates__th_num"><?= Yii::t('app', 'Buy') ?></th>
                        <th class="rates__th rates__th_num"><?= Yii::t('app', 'Sell') ?></th>
                        <th class="rates__th rates__th_num"><?= Yii::t('app', 'Debit') ?></th>
                        <th class="rates__th rates__th_num"><?= Yii::t('app', 'Credit') ?></th>
                        <th class="rates__th rates__th_num"><?= Yii::t('app', 'Middle') ?></th>
                    </tr>
                    </thead>
                    <tbody class="rates__tbody">
                    <?php foreach ($models as $key => $model): if($key < 2) continue; ?>
                        <tr class="rates__tr rates__tr_body">

                            <td class="rates__td rates__td_flag">
                                <div class="uk-flex uk-flex-middle">
                                    <div class="rates__flag">
                                        <img src="<?= $model->icon_path ?>" alt="">
                                    </div>
                                    <div class="uk-hidden@l">
                                        <p><?= $model->name ?></p>
                                    </div>
                                </div>
                                <?php if($model->volume): ?>
                                    <p class="rates__small uk-margin-small-top"><?= Yii::t('app', 'Currency to {0}', $model->volume) ?></p>
                                <?php endif ?>
                            </td>
                            <td class="rates__td rates__td_title">
                                <p><?= $model->name ?></p>
                                <?php if($model->volume): ?>
                                    <p><?= Yii::t('app', 'Currency to {0}', $model->volume) ?></p>
                                <?php endif ?>
                            </td>
                            <td class="rates__td rates__td_num"><?= $model->buy_1_result ?></td>
                            <td class="rates__td rates__td_num"><?= $model->sell_1_result ?></td>
                            <td class="rates__td rates__td_num"><?= $model->debit_result ?></td>
                            <td class="rates__td rates__td_num"><?= $model->credit_result ?></td>
                            <td class="rates__td rates__td_num"><?= $model->middle ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="end_sticky"></div>
                <div class="rates__more uk-hidden@s">
                    <button class="btn btn_green"><?= Yii::t('app', 'All currencies') ?></button>
                </div>
            </div>
        </div>

    </div>
</div>
