<?php

namespace account\models;

use yii\base\Model;
use common\models\User;
use Yii;

class ChangePasswordForm extends Model
{
    public $oldPassword;

    public $newPassword;

    public $newPasswordRepeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['oldPassword', 'findPassword'],
            ['newPasswordRepeat','compare','compareAttribute'=>'newPassword'],

            [['newPassword', 'newPasswordRepeat'], 'string', 'min' => 6],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'newPasswordRepeat' => Yii::t('app', 'Confirm new pass'),
            'oldPassword' => Yii::t('app', 'Old password'),
            'newPassword' => Yii::t('app', 'New password')
        ];
    }

    public function findPassword($attribute, $params)
    {
        $user = User::findOne(Yii::$app->user->id);
        if(!$user->validatePassword($this->{$attribute})) {
            $this->addError($attribute, Yii::t('app', 'Old password is incorrect.'));
        }
    }
}