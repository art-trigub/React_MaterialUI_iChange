<?php

namespace frontend\widgets;

class ExportMenu extends \kartik\export\ExportMenu
{
    /**
     * Registers client assets needed for Export Menu widget
     * @throws \Exception
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        ExportMenuAsset::register($view);

        $options = [
            'target' => $this->target,
            'formOptions' => $this->exportFormOptions,
            'messages' => $this->messages,
            'exportType' => $this->_exportType,
            'colSelFlagParam' => $this->colSelFlagParam,
            'colSelEnabled' => $this->_columnSelectorEnabled ? 1 : 0,
            'exportRequestParam' => $this->exportRequestParam,
            'exportTypeParam' => $this->exportTypeParam,
            'exportColsParam' => $this->exportColsParam,
            'exportFormHiddenInputs' => $this->exportFormHiddenInputs,
            'showConfirmAlert' => $this->showConfirmAlert,
            'dialogLib' => ArrayHelper::getValue($this->krajeeDialogSettings, 'libName', 'krajeeDialog'),
        ];

        $options = Json::encode($options);
        $menu = 'kvexpmenu_' . hash('crc32', $options);
        $view->registerJs("var {$menu} = {$options};\n", View::POS_HEAD);
        $script = '';
        foreach ($this->exportConfig as $format => $setting) {
            if (!isset($setting) || $setting === false) {
                continue;
            }
            $id = $this->options['id'] . '-' . strtolower($format);
            $options = Json::encode([
                'settings' => new JsExpression($menu),
                'alertMsg' => $setting['alertMsg'],
            ]);
            $script .= "jQuery('#{$id}').exportdata({$options});\n";
        }


        if (!empty($script) && isset($this->pjaxContainerId)) {
            $script .= "jQuery('#{$this->pjaxContainerId}').on('pjax:complete', function() {
                {$script}
            });\n";
        }
        $view->registerJs($script);
    }
}