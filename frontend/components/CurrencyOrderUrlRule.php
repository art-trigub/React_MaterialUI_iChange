<?php

namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

use Yii;

class CurrencyOrderUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'currencies/order') {

            return Yii::$app->user->isGuest ? $route : '/account/currency-ordering/order';
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        return false;
    }
}