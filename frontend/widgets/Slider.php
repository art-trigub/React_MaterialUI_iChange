<?php

namespace frontend\widgets;

use common\models\Slide;
use yii\base\Widget;

class Slider extends Widget
{
    function run()
    {
        $models = Slide::find()->orderBy('slide_id DESC')->all();
        if(!$models) {
            return '';
        }

        return $this->render('slider', [
            'models' => $models
        ]);
    }
}
