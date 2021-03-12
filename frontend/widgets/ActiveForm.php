<?php

namespace frontend\widgets;


class ActiveForm extends \yii\bootstrap\ActiveForm
{
    public $fieldClass = 'frontend\widgets\ActiveField';

    public $layout = 'horizontal';
}