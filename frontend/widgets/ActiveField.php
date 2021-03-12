<?php

namespace frontend\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;



class ActiveField extends \yii\bootstrap\ActiveField
{

    public $options = ['class' => 'form__grid'];

    public $labelWrapperOptions = [];

    public $fieldWrapperOptions = [];

    public $size = '';

    /**
     * @var string the template for checkboxes in default layout
     */
    public $checkboxTemplate = "<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
    /**
     * @var string the template for radios in default layout
     */
    public $radioTemplate = "<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
    /**
     * @var string the template for checkboxes in horizontal layout
     */
    public $horizontalCheckboxTemplate = "{beginLabelWrapper}\n{endLabelWrapper}\n{beginFieldWrapper}\n{beginWrapper}\n<div class=\"checkbox\">{input}\n{label}\n{error}\n</div>\n{endWrapper}\n{endFieldWrapper}\n{hint}";
    /**
     * @var string the template for radio buttons in horizontal layout
     */
    public $horizontalRadioTemplate = "{beginWrapper}\n<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}";
    /**
     * @var string the template for inline checkboxLists
     */
    public $inlineCheckboxListTemplate = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
    /**
     * @var string the template for inline radioLists
     */
    public $inlineRadioListTemplate = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
    /**
     * @var bool whether to render the error. Default is `true` except for layout `inline`.
     */
    public $enableError = true;
    /**
     * @var bool whether to render the label. Default is `true`.
     */
    public $enableLabel = true;


    /**
     * {@inheritdoc}
     */
    public function render($content = null)
    {
        if ($content === null) {
            if(!isset($this->parts['{beginLabelWrapper}'])) {
                $options = $this->labelWrapperOptions;
                $options['class'] = 'form__grid-el ' . ArrayHelper::remove($options, 'class', '');
                if($this->size) {
                    Html::addCssClass($options, 'form__grid-el_' . $this->size);
                }

                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginLabelWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endLabelWrapper}'] = Html::endTag($tag);
            }

            if(!isset($this->parts['{beginFieldWrapper}'])) {
                $options = $this->fieldWrapperOptions;
                $options['class'] = 'form__grid-el ' . ArrayHelper::remove($options, 'class', '');
                if($this->size) {
                    Html::addCssClass($options, 'form__grid-el_' . $this->size);
                }

                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginFieldWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endFieldWrapper}'] = Html::endTag($tag);
            }

//            if(!isset($this->parts['{beginLabelWrapper}'])) {
//                $options = $this->labelWrapperOptions;
//                $options['class'] = 'form__grid-el ' . ArrayHelper::remove($options, 'class', '');
//
//                $tag = ArrayHelper::remove($options, 'tag', 'div');
//                $this->parts['{beginLabelWrapper}'] = Html::beginTag($tag, $options);
//                $this->parts['{endLabelWrapper}'] = Html::endTag($tag);
//            }

            if (!isset($this->parts['{beginWrapper}'])) {
                $options = $this->wrapperOptions;
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endWrapper}'] = Html::endTag($tag);
            }
            if ($this->enableLabel === false) {
                $this->parts['{beginLabelWrapper}'] = '';
                $this->parts['{label}'] = '';
                $this->parts['{beginLabel}'] = '';
                $this->parts['{labelTitle}'] = '';
                $this->parts['{endLabel}'] = '';
                $this->parts['{endLabelWrapper}'] = '';
            } elseif (!isset($this->parts['{beginLabel}'])) {
                $this->renderLabelParts();
            }
            if ($this->enableError === false) {
                $this->parts['{error}'] = '';
            }
            if ($this->inputTemplate) {
                $input = isset($this->parts['{input}']) ?
                    $this->parts['{input}'] : Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
                $this->parts['{input}'] = strtr($this->inputTemplate, ['{input}' => $input]);
            }
        }
        return parent::render($content);
    }

    protected function createLayoutConfig($instanceConfig)
    {
        $config = [
            'hintOptions' => [
                'tag' => 'p',
                'class' => 'help-block',
            ],
            'errorOptions' => [
                'tag' => 'p',
                'class' => 'help-block help-block-error',
            ],
            'inputOptions' => [
                'class' => 'form-control',
            ],
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            //$config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";

            $config['template'] = "{beginLabelWrapper}\n{label}\n{endLabelWrapper}\n{beginFieldWrapper}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{endFieldWrapper}\n{hint}";

            $cssClasses = array_merge([
                'offset' => '',
                'label' => '',
                'wrapper' => 'form-group',
                'error' => '',
                'hint' => '',
            ], $this->horizontalCssClasses);
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;
            $config['wrapperOptions'] = ['class' => $cssClasses['wrapper']];
            $config['labelOptions'] = ['class' => 'control-label form__title ' . $cssClasses['label']];
            $config['errorOptions']['class'] = 'help-block help-block-error ' . $cssClasses['error'];
            $config['hintOptions']['class'] = 'help-block ' . $cssClasses['hint'];
        } elseif ($layout === 'inline') {
            $config['labelOptions'] = ['class' => 'sr-only'];
            $config['enableError'] = false;
        }

        return $config;
    }

    /**
     * Generates a label tag for [[attribute]].
     * @param null|string|false $label the label to use. If `null`, the label will be generated via [[Model::getAttributeLabel()]].
     * If `false`, the generated field will not contain the label part.
     * Note that this will NOT be [[Html::encode()|encoded]].
     * @param null|array $options the tag options in terms of name-value pairs. It will be merged with [[labelOptions]].
     * The options will be rendered as the attributes of the resulting tag. The values will be HTML-encoded
     * using [[Html::encode()]]. If a value is `null`, the corresponding attribute will not be rendered.
     * @return $this the field object itself.
     */
//    public function label($label = null, $options = [])
//    {
//        if ($label === false) {
//            $this->parts['{label}'] = '';
//            return $this;
//        }
//
//        $options = array_merge($this->labelOptions, $options);
//        if ($label !== null) {
//            $options['label'] = $label;
//        }
//
////        if ($this->_skipLabelFor) {
////            $options['for'] = null;
////        }
//
//        $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $options);
//
//        return $this;
//    }

    /**
     * {@inheritdoc}
     */
    public function label($label = null, $options = [])
    {
        if (is_bool($label)) {
            $this->enableLabel = $label;
            if ($label === false && $this->form->layout === 'horizontal') {
                Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
            }
        } else {
            $this->enableLabel = true;
            $this->renderLabelParts($label, $options);
            parent::label($label, $options);
        }
        return $this;
    }


    /**
     * @param string|null $label the label or null to use model label
     * @param array $options the tag options
     */
    protected function renderLabelParts($label = null, $options = [])
    {
        $options = array_merge($this->labelOptions, $options);
        if ($label === null) {
            if (isset($options['label'])) {
                $label = $options['label'];
                unset($options['label']);
            } else {
                $attribute = Html::getAttributeName($this->attribute);
                $label = Html::encode($this->model->getAttributeLabel($attribute));
            }
        }
        if (!isset($options['for'])) {
            $options['for'] = Html::getInputId($this->model, $this->attribute);
        }
        $this->parts['{beginLabel}'] = Html::beginTag('label', $options);
        $this->parts['{endLabel}'] = Html::endTag('label');
        if (!isset($this->parts['{labelTitle}'])) {
            $this->parts['{labelTitle}'] = $label;
        }
    }


    public function dropDownList($items, $options = [])
    {
        $options = array_merge($this->inputOptions, $options);

        Html::addCssClass($this->wrapperOptions, 'form__wrap-select');
        Html::addCssClass($options, 'form__select');

        if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_INPUT) {
            $this->addErrorClassIfNeeded($options);
        }

        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeDropDownList($this->model, $this->attribute, $items, $options);

        return $this;
    }


}