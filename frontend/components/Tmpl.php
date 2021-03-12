<?php

namespace frontend\components;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use Yii;

class Tmpl extends Component
{
	public $defaultData = [];

	public function init()
	{
		ArrayHelper::setValue($this->defaultData, 'link_lang', '/' . Yii::$app->language);

		parent::init(); // TODO: Change the autogenerated stub
	}
    /**
     * @param $tmpl
     * @param $data Array or Object
     * @return null|string|string[]
     */
    public function render($tmpl, $data)
    {
        $tmpl = str_replace("\r\n",'', $tmpl);
        $result = preg_replace_callback("/\[\[if ([^\]]+)\]\](((?![[\/if]]).)*)\[\[\/if\]\]/i",
            function ($matches) use ($data) {
                if ($this->getValue($data, $matches[1])) {
                    return $matches[2];
                }

                return '';
            },
            $tmpl
        );

        $result = preg_replace_callback(
            "/\[\[([^\]]+)\]\]/i",
            function ($matches) use ($data) {
                if ($value = $this->getValue($data, $matches[1])) {
                    return $value;
                }


                if($value = $this->getValue($this->defaultData, $matches[1])) {
					return $value;
				}

                return '';
            },
            $result
        );

        return $result;
    }

	/**
	 * @param $data
	 * @param $value
	 * @return mixed|string
	 */
    private function getValue($data, $value)
    {
        if(is_array($data)) {
            return isset($data[$value]) && !empty($data[$value]) ? $data[$value] : '';
        } elseif($data instanceof \yii\base\BaseObject) {
            return $data->canGetProperty($value) && !empty($data->{$value}) ? $data->{$value} : '';
        }

        return '';
    }
}