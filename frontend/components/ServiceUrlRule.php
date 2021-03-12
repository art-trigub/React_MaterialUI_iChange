<?php

namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use common\models\Service;

class ServiceUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'services/view') {
            if (isset($params['url']) && false == empty($params['url'])) {
                return $params['url'];
            }

            return 'services/' . $params['id'];
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('/^([\w\-\/]+)$/i', $pathInfo, $matches)) {
            if($model = Service::find()->where(['url' => $matches[0]])->one()) {
                $params['id'] = $model->service_id;
                $params['url'] = $matches[0];
                return ['services/view', $params];
            }
        }
        return false;
    }
}