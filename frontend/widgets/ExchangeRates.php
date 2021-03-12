<?php

namespace frontend\widgets;

use common\models\Currency;
use yii\base\Widget;

class ExchangeRates extends Widget
{
    function run()
    {
        $models = Currency::find()->orderBy('weight ASC')->limit(3)->all();
        return $this->render('exchangeRates', compact('models'));
    }
}