<?php

namespace backend\controllers;

use backend\components\Controller;
use common\models\CardParamLang;
use common\models\Currency;
use common\models\CurrencyCrossRate;
use common\models\CurrencyOld;
use common\models\News;
use yii\helpers\ArrayHelper;
use common\models\CardParam;
use Yii;
use SendGrid\Mail\Mail;

class TestController extends Controller
{
    function actionIndex()
    {
        $c = Currency::find()->with(['crossRates'])->all();

        $result = ArrayHelper::toArray($c, [
            'common\models\Currency' => [
                'currency_id',
                'icon',
                'name',
                'data' => function($model) {
                    return ArrayHelper::index(ArrayHelper::toArray($model->crossRates, [
                        'common\models\CurrencyCrossRate' => [
                            'group_id',
                            'sell',
                            'buy'
                        ]
                    ]), 'group_id');
                }
            ]
        ]);

        var_dump($result); exit;
        //var_dump($c); exit;
        return $this->render('empty');
    }

    function actionCurrency()
    {
        //$model = Currency::findOne(1);

        (new Currency())->trigger(Currency::EVENT_RATES_UPDATED);
    }

    function actionNews()
    {
        $model = News::findOne(1);

        var_dump($model->getRelated()->all());

        return $this->render('empty');
    }

    function actionParam($id)
    {
        $model = CardParam::findOne($id);
        $model->delete();
    }

    public function actionSms()
	{
		Yii::$app->sms->send(['972543044028'], 'test message');
		exit();
	}

    public function actionMail()
	{
//		$res = Yii::$app->mailer->compose()
//			->setFrom('info@temp.i-change.co.il')
//			->setTo('rolf.webner@gmail.com')
//			->setSubject('Message subject')
//			->setTextBody('Plain text content')
//			->setHtmlBody('<b>HTML content</b>')
//			->send();
//
//		var_dump($res);
	}

    public function actionMailSendGrid()
	{
        $email = new Mail();
        $email->setFrom("info@temp.creativeowl.biz", "Example User");
        $email->setSubject("Sending with Twilio SendGrid is Fun");
        $email->addTo("sergei.potenko@gmail.com", "Example User");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
	}
}
