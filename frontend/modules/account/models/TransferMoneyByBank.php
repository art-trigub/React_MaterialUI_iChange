<?php

namespace account\models;

use yii\base\Model;

class TransferMoneyByBank extends Model
{
    public $test;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

        ];
    }
}