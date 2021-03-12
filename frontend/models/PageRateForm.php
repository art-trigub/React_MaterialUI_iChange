<?php

namespace frontend\models;

use common\models\PageRating;
use yii\base\Model;
use yii\web\Cookie;
use yii\helpers\Json;

use Yii;

class PageRateForm extends Model
{
    public $url;

    public $action;

    public $vote;

    const ACTION_LIKE = 'like';

    const ACTION_DISLIKE = 'dislike';

    const COOKIE_PARAM = 'page_rate';

    /**
     * @var \common\models\PageRating
     */
    private $_page;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'action'], 'required'],
            ['action', 'validateAction'],
            ['url', 'validateUrl'],
            ['vote', 'validateVote', 'skipOnEmpty' => false]
        ];
    }

    public function validateAction($attribute, $params)
    {
        if(!in_array($this->{$attribute}, [self::ACTION_LIKE, self::ACTION_DISLIKE])) {
            $this->addError($attribute, 'Action must be ' . self::ACTION_LIKE . ' or ' .self::ACTION_DISLIKE);
        }
    }

    public function validateUrl($attribute, $params)
    {
        $this->_page = PageRating::findOne(['url' => $this->{$attribute}]);
        if(!$this->_page) {
            $this->addError($attribute, 'Page with this url not found');
        }
    }

    public function validateVote($attribute, $params)
    {
        $cookieData = self::getUrlsFromCookie();
        if(in_array($this->url, $cookieData)) {
            $this->addError($attribute, 'This page already voted');
        }
    }

    public function vote()
    {
        if($this->_page) {
            $page = $this->_page;
            if($this->action == self::ACTION_LIKE) {
                $page->updateCounters(['like_count' => 1]);
            } else if($this->action == self::ACTION_DISLIKE) {
                $page->updateCounters(['dislike_count' => 1]);
            }

            $cookieData = self::getUrlsFromCookie();
            if(!in_array($this->url, $cookieData)) {
                $cookieData[] = $this->url;
            }

            $cookie = new Cookie([
                'name'   => self::COOKIE_PARAM,
                'value'  => $cookieData,
                'expire' => time() + 2582000,
                'domain' => Yii::$app->request->getHostName()
            ]);

            Yii::$app->response->cookies->add($cookie);

            return true;
        }

        return null;
    }

    public static function getUrlsFromCookie()
    {
        $cookieData = Yii::$app->request->cookies->getValue(self::COOKIE_PARAM, []);
        if(!is_array($cookieData)) {
            $cookieData = [];
        }

        return $cookieData;
    }
}