<?php

namespace frontend\widgets;

use frontend\models\ContactForm;
use yii\base\Widget;

use Yii;

class ContactsFormWidget extends Widget
{
    public $attributes = [];
    function run()
    {
        $model = new ContactForm();
        $model->setAttributes($this->attributes);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contactsFormWidget', [
                'model' => $model,
            ]);
        }
    }
}