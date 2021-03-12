<?php

namespace backend\widgets\grid;

use yii\helpers\Url;
use yii\helpers\Html;

class LanguageActionColumn extends \lav45\translate\grid\ActionColumn
{
    protected function initDefaultButtons()
    {
        foreach ($this->languages as $lang_id => $lang) {
            $name = "update-$lang_id";
            $this->template .= ' {' . $name . '}';
            if (!isset($this->buttons[$name])) {
                $this->buttons[$name] = function() use ($lang, $lang_id) {
                    /** @var \lav45\translate\TranslatedTrait $model */
                    $model = func_get_arg(1);
                    $key = func_get_arg(2);

                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[$this->languageAttribute] = $lang_id;
                    $params[0] = $this->controller ? $this->controller . '/update' : 'update';

                    $url = Url::toRoute($params);

                    //$color = $model->hasTranslate($lang_id) ? 'info' : 'default';
                    $color = $model->language == $lang_id ? 'info' : 'default';

                    $options = [
                        'class' => "btn btn-sm btn-$color",
                        'title' => "Edit $lang version",
                        'data-pjax' => '0',
                    ];

                    if ($this->ajax) {
                        $options['data-href'] = $url;
                        return Html::button($lang, $options);
                    } else {
                        return Html::a($lang, $url, $options);
                    }
                };
            }
        }
    }
}