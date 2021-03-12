<?php

namespace backend\widgets\metronic;
use yii\bootstrap4\Html;

class ActiveField extends \yii\bootstrap4\ActiveField
{
    public $switchOptions = ['class' => 'm-switch'];

    /**
     * {@inheritdoc}
     */
    public function switcher($options = [], $enclosedByLabel = false)
    {
        Html::removeCssClass($options, 'form-control');
        Html::addCssClass($options, 'form-check-input');
        Html::addCssClass($this->labelOptions, 'form-check-label');

        $this->template =  $this->getSwitcherTemplate($options);

        if ($this->form->layout === ActiveForm::LAYOUT_HORIZONTAL) {
            Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
        }

        if ($enclosedByLabel) {
            if (isset($options['label'])) {
                $this->parts['{labelTitle}'] = $options['label'];
            }
        }

        return \yii\widgets\ActiveField::checkbox($options, false);
    }



    public function fileInput($options = [])
    {
        // https://github.com/yiisoft/yii2/pull/795
        if ($this->inputOptions !== ['class' => 'form-control']) {
            $options = array_merge($this->inputOptions, $options);
        }
        Html::addCssClass($options, 'custom-file-input');
        // https://github.com/yiisoft/yii2/issues/8779
        if (!isset($this->form->options['enctype'])) {
            $this->form->options['enctype'] = 'multipart/form-data';
        }

        if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_INPUT) {
            $this->addErrorClassIfNeeded($options);
        }

        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);

        $this->template = $this->fileTemplate;

        $this->parts['{input}'] = Html::activeFileInput($this->model, $this->attribute, $options);

        return $this;
    }

    public function getSwitcherTemplate($options)
    {
        $switchOptions = ['class' => 'm-switch'];
        if(isset($options['switchClass'])) {
            Html::addCssClass($switchOptions, $options['switchClass']);
        }

        return Html::beginTag('span', $switchOptions) .  "<label>\n{input}\n<span></span></label>" . Html::endTag('span');
    }


    public function getFileTemplate()
    {
        $labelOptions = [
            'class' => 'custom-file-label selected',
            'for' => Html::getInputId($this->model, $this->attribute)
        ];

        return "{label}\n<div class=\"custom-file\">{input}".Html::tag('label','', $labelOptions)."</div>\n{hint}\n{error}";
    }
}