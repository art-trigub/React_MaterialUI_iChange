<?php

namespace backend\widgets;
use yii\helpers\Html;

class LinkPager extends \yii\widgets\LinkPager
{

    public $options = ['class' => 'pagination'];
    /**
     * @var array HTML attributes which will be applied to all link containers
     * @since 2.0.13
     */
    public $linkContainerOptions = [];
    /**
     * @var array HTML attributes for the link in a pager container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $linkOptions = ['class' => 'page-link'];
    /**
     * @var string the CSS class for the each page button.
     * @since 2.0.7
     */
    public $pageCssClass = 'paginate_button page-item';
    /**
     * @var string the CSS class for the "first" page button.
     */
    public $firstPageCssClass = ' paginate_button page-item first';
    /**
     * @var string the CSS class for the "last" page button.
     */
    public $lastPageCssClass = ' paginate_button page-item last';
    /**
     * @var string the CSS class for the "previous" page button.
     */
    public $prevPageCssClass = 'paginate_button page-item previous';
    /**
     * @var string the CSS class for the "next" page button.
     */
    public $nextPageCssClass = ' paginate_button page-item next';
    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'active';
    /**
     * @var string the CSS class for the disabled page buttons.
     */
    public $disabledPageCssClass = 'disabled';

    public $disabledListItemSubTagOptions = [
        'tag' => 'span',
        'class' => 'page-link'
    ];

    /**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        echo Html::beginTag('div', [
            'class' => 'dataTables_paginate paging_full_numbers'
        ]);
        echo $this->renderPageButtons();
        echo Html::endTag('div');
    }
}