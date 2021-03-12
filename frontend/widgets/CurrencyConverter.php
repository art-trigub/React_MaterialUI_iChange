<?php

namespace frontend\widgets;

use yii\base\Widget;

class CurrencyConverter extends Widget
{
    function run()
    {
        return $this->render('currencyConverter');
    }
}