<?php


namespace frontend\widgets;

use common\models\Banner as BannerModel;
use yii\base\Widget;

use Yii;

class Banner extends Widget
{
    public $name;

    function run()
    {
        $cacheKey = ['banner', 'id' => $this->name, 'lang' => Yii::$app->language];
        if(!$html = Yii::$app->cache->get($cacheKey)) {
            $model = BannerModel::findOne(['name' => $this->name]);
            if (!$model) {
                return;
            }

            $html = preg_replace_callback("/\[\[if ([^\]]+)\]\](.*)\[\[\/if\]\]/i",
                function ($matches) use ($model) {
                    if ($model->canGetProperty($matches[1]) && !empty($model->{$matches[1]})) {
                        return $matches[2];
                    }

                    return '';
                },
                $model->template
            );

            $html = preg_replace_callback(
                "/\[\[([^\]]+)\]\]/i",
                function ($matches) use ($model) {
                    if ($model->canGetProperty($matches[1])) {
                        return $model->{$matches[1]};
                    }

                    return '';
                },
                $html
            );

            $dependency = new \yii\caching\TagDependency([
                'tags' => ['banner', $this->name]
            ]);
            Yii::$app->cache->set($cacheKey, $html, 0, $dependency);
        }

        echo $html;
    }
}
