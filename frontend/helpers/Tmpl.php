<?php

namespace frontend\helpers;


class Tmpl
{
    /**
     * @param $tmpl
     * @param $data Array or Object
     */
    public static function test($tmpl, $data)
    {
        $html = preg_replace_callback("/\[\[if ([^\]]+)\]\](.*)\[\[\/if\]\]/i",
            function ($matches) use ($data) {
                if ($model->canGetProperty($matches[1]) && !empty($model->{$matches[1]})) {
                    return $matches[2];
                }

                return '';
            },
            $tmpl
        );

        $html = preg_replace_callback(
            "/\[\[([^\]]+)\]\]/i",
            function ($matches) use ($model) {
                if ($model->canGetProperty($matches[1])) {
                    return $model->{$matches[1]};
                }

                return '';
            },
            $html
        );
    }
}