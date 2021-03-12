<?php

namespace frontend\components;

use common\models\FaqCategory;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class FaqUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'faq/category') {
            if (isset($params['url']) && false == empty($params['url'])) {
                return $params['url'];
            }

            return 'faq/category/' . $params['id'];
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('/^([\w\-\/]+)$/i', $pathInfo, $matches)) {
            if($model = FaqCategory::find()->where(['url' => $matches[0]])->one()) {
                $params['category_id'] = $model->faq_category_id;
                $params['url'] = $matches[0];
                return ['faq/index', $params];
            }

        }
        return false;
    }
}
