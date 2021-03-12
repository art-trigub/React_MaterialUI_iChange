<?php


namespace frontend\widgets;

use yii\base\Widget;
use common\models\News as NewsModel;

class News extends Widget
{
    function run()
    {
        $models = NewsModel::findAll(['is_top' => 1]);
        if(!$models) {
            return ;
        }

        return $this->render('news', [
            'models' => $models
        ]);
    }
}