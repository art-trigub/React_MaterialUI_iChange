<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_phone".
 *
 * @property int $user_phone_id
 * @property int $user_id
 * @property string $phone
 */
class UserPhone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_phone_id' => 'User Phone ID',
            'user_id' => 'User ID',
            'phone' => 'Phone',
        ];
    }
}
