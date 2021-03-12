<?php
namespace frontend\widgets;

use yii\base\InvalidConfigException;
use common\models\ContentBlock as ContentBlockModel;
use yii\helpers\Json;

class ContentBlock extends \yii\base\Widget
{
    public $name = false;

    function run()
    {
        if(!$this->name) {
            throw new InvalidConfigException('ContentBlock::name must be set.');
        }

        $model = ContentBlockModel::findOne([
            'name' => $this->name
        ]);

        if($model) {
            $chunks = $model->getChunksData();
            $content = preg_replace_callback(
                "/\[\[(.*)\]\]/i",
                function ($matches) use ($chunks) {
                    return $chunks[$matches[1]] ?: "";
                },
                $model->body
            );

            echo $content;
        }
    }
}