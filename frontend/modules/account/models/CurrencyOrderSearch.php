<?php

namespace account\models;

use yii\data\ActiveDataProvider;
use common\models\CurrencyOrder;
use yii\helpers\ArrayHelper;

class CurrencyOrderSearch extends CurrencyOrder
{
    function search()
    {
        $query = self::find();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => -1
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [

        ]);
    }
}