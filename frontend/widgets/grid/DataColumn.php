<?php

namespace frontend\widgets\grid;

class DataColumn extends \yii\grid\DataColumn
{
    public $headerOptions = ['class' => 'summary__th'];

    public $contentOptions = ['class' => 'summary__td'];
}