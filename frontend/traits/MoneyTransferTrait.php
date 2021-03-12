<?php

namespace frontend\traits;

use common\models\Country;
use common\models\Currency;
use Yii;
use yii\helpers\ArrayHelper;


trait MoneyTransferTrait
{
    public function registerJsConfig()
    {
        Yii::$app->jsConfig->add([
            'countryList' => ArrayHelper::index(ArrayHelper::toArray(Country::find()->orderBy((new Country())->getLangAttributeName('name'))->where(['visible' => 1])->all(), [
                'common\models\Country' => [
                    'country_id',
                    'currency' => function ($model) {
                        return $model->currency ? $model->currency->name : false;
                    },
                    'name'
                ]
            ]), 'country_id'),
            'currencyList' => ArrayHelper::index(ArrayHelper::toArray(Currency::find()->all(), [
                'common\models\Currency' => [
                    'currency_id',
                    'name',
                    'symbol',
                    'crossrate' => function ($model) {
                        return (float)($model->transfer ?: $model->buy_1_result);
                    },
                ]
            ]), 'name')
        ]);
    }

}
