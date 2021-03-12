<?php

namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use common\models\News;

class NewsUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'news/view') {
            if (isset($params['url']) && false == empty($params['url'])) {
                return $params['url'];
            }

            return 'news/view/' . $params['id'];
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('/^([\w\-\/]+)$/i', $pathInfo, $matches)) {
            if($category = News::find()->where(['url' => $matches[0]])->one()) {
                $params['id'] = $category->news_id;
                $params['url'] = $matches[0];
                return ['news/view', $params];
            }

        }
        return false;
    }
}
