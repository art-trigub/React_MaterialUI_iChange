<?php

namespace frontend\widgets\grid;

class SerialColumn extends \yii\grid\SerialColumn
{
    public $headerOptions = ['class' => 'summary__th'];

    public $contentOptions = ['class' => 'summary__td'];
}