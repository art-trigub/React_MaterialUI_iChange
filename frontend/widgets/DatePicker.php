<?php

namespace frontend\widgets;

use yii\helpers\Html;

class DatePicker extends \kartik\date\DatePicker
{

    protected function initIcon($type, $bs3Icon, $bs4Icon)
    {
        $css = $this->isBs4() ? "fas fa-{$bs4Icon}" : "glyphicon glyphicon-{$bs3Icon}";
        $icon = $type . 'Icon';
        if (!isset($this->$icon)) {
            $this->$icon = Html::tag('i', '', ['class' => $css . ' test kv-dp-icon']);
        }
    }
}