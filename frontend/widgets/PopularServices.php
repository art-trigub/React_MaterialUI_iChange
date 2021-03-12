<?php


namespace frontend\widgets;

use common\models\Service;
use yii\base\Widget;

class PopularServices extends Widget
{
    function run()
    {
        $models = Service::findAll(['is_popular' => 1]);
        if(!$models) {
            return ;
        }

        return $this->render('popularServices', compact('models'));
    }
}