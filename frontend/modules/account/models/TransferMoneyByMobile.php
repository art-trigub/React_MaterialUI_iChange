<?php

namespace account\models;

use yii\base\Model;

class TransferMoneyByMobile extends Model
{
    public $phone;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
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