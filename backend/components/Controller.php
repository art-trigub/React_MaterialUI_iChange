<?php


namespace backend\components;

use yii\base\Event;
use yii\web\View;

use Yii;

class Controller extends \yii\web\Controller
{
    use AdminTrait;

    const STATUS_OK = 'OK';

    const STATUS_ERR = 'ERR';

    public function init()
    {
        parent::init();
        Event::on(View::className(), View::EVENT_BEGIN_PAGE, function($event) {
            if($this->action) {
                Yii::$app->jsConfig->add([
                    'page' => "{$this->id}/{$this->action->id}",
                ]);
            }
        });
    }
}