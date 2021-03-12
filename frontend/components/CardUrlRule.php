<?php

namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use common\models\Card;

class CardUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'cards/order') {
            if (isset($params['url']) && false == empty($params['url'])) {
                return 'cards/order/' . $params['url'];
            }

            return 'cards/order/' . $params['id'];
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('/^cards\/order\/([\w\-\/]+)$/i', $pathInfo, $matches)) {
            if($model = Card::find()->where(['url' => $matches[1]])->one()) {
                $params['id'] = $model->card_id;
                $params['url'] = $matches[1];
                return ['cards/order', $params];
            }
        }
        return false;
    }
}