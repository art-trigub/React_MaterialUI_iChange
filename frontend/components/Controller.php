<?php

namespace frontend\components;

use common\models\Currency;
use yii\base\Event;
use common\models\Page;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\NotFoundHttpException;

use Yii;

class Controller extends \yii\web\Controller
{
    public $layout = '//main';

    public function init()
    {
        parent::init();
        Event::on(View::className(), View::EVENT_BEFORE_RENDER, function($event) {
            if($this->action) {
                Yii::$app->jsConfig->add([
                    'DEBUG'    => YII_DEBUG,
                    'page'     => "{$this->id}/{$this->action->id}",
                    'language' => Yii::$app->language,
                    'crossRates' => ArrayHelper::index(ArrayHelper::toArray(Currency::getValidated()->all(), [
                        'common\models\Currency' => [
                            'name',
                            'sell_1_result',
                            'sell_2_result',
                            'buy_1_result',
                            'buy_2_result',
                            'credit',
                            'debit',
                            'middle',
                            'volume',
                        ]
                    ]), 'name'),
                    'user' => [
                        'isGuest' => Yii::$app->user->isGuest
                    ]
                ]);

                Yii::$app->view->params['contacts'] = Contacts::getModel();
                Yii::$app->view->params['header'] = (new Page)->getPagesList(Page::PAGE_CATEGORY_HEADER);
                Yii::$app->view->params['footer'] = (new Page)->getPagesList(Page::PAGE_CATEGORY_FOOTER);
            }
        });
    }

	/**
	 * @param  false  $message
	 * @throws NotFoundHttpException
	 */
    public function NotFoundException($message = false)
    {
        throw new NotFoundHttpException($message?: Yii::t('app', 'The address is incorrectly typed, or such a page on the site no longer exists.'));
    }
}
