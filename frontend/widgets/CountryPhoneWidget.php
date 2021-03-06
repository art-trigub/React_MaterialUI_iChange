<?php

namespace frontend\widgets;


use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\web\View;

class CountryPhoneWidget extends InputWidget
{
    public $pointerFieldId;

    public $items = [];

    public $itemsOptions = [];

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        if($this->pointerFieldId) {
            $id = Html::getInputId($this->model, $this->attribute);
            $this->getView()->registerJs(
                'function changeCountryPhoneCode(countrySelect, pointerFieldId) {
                    var phoneCode = countrySelect.find(":selected").data("code");
                    var pointerField = $("#" + pointerFieldId);
                    //if(pointerField.val() == "") {
                        $("#" + pointerFieldId).val(phoneCode);
                    //}
                }',
                View::POS_READY,
                __CLASS__ . 'country_phone'
            );

            $this->getView()->registerJs(
                'changeCountryPhoneCode($("#' . $id .'"), "'.$this->pointerFieldId.'");
                    $("#' . $id .'").on("change", function(e) {
                        changeCountryPhoneCode($(this), "'.$this->pointerFieldId.'")
                    })'
            );
        }

        return Html::activeDropDownList($this->model, $this->attribute, $this->items, [
            'options' => $this->itemsOptions,
            'class'   => 'form-control form__select'
        ]);
    }
}