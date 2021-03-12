<?php

namespace account\models;

use common\models\Transaction;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use Yii;

class TransactionSearch extends Transaction
{
    /**
     * @var
     */
    public $beneficiaryName;

    /**
     * @var
     */
    public $beneficiaryCountryName;

    public $beneficiaryType;

    function search()
    {
        $query = self::find()
            ->alias('t')
            ->innerJoinWith(['beneficiary'])
            ->where(['t.user_id' => Yii::$app->user->id]);

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
            'beneficiaryName'        => Yii::t('app', 'Receiver’s name'),
            'beneficiaryCountryName' => Yii::t('app', 'Country'),
            'beneficiaryType'        => Yii::t('app', 'Type')
        ]);
    }
}