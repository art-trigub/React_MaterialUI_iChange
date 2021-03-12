<?php

namespace frontend\widgets\grid;
use yii\helpers\Html;

class StatusColumn extends DataColumn
{
    /**
     * @var array status => color
     */
    public $statusCssClass = [

    ];

    public function renderDataCell($model, $key, $index)
    {
        if ($this->contentOptions instanceof Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }

        if(isset($this->statusCssClass[$model->{$this->attribute}])) {
            Html::addCssClass($options, $this->statusCssClass[$model->{$this->attribute}]);
        }

        return Html::tag('td', $this->renderDataCellContent($model, $key, $index), $options);
    }
}