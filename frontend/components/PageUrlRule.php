<?php

namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use common\models\Page;

class PageUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'page/view') {
            if (isset($params['url']) && false == empty($params['url'])) {
                return $params['url'];
            }

            return 'page/' . $params['id'];
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('/^([\w\-\/]+)$/i', $pathInfo, $matches)) {
            if($page = Page::find()->where(['url' => $matches[0]])->one()) {
                $params['id'] = $page->page_id;
                $params['url'] = $matches[0];
                return ['page/view', $params];
            }
        }
        return false;
    }
}