<?php

namespace backend\widgets\grid;

use yii\grid\GridViewAsset;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class GridView extends \yii\grid\GridView
{
    //public $filterErrorOptions = ['class' => 'invalid-feedback'];

    public $options = ['class' => 'grid-view dataTables_wrapper dt-bootstrap4 no-footer'];

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->getView()->registerCssFile("@web/dist/metronic/assets/vendors/custom/datatables/datatables.bundle.css");
        parent::run();
    }

    /**
     * Renders the pager.
     * @return string the rendering result
     */
    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
        /* @var $class LinkPager */
        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', \backend\widgets\LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();

        return $class::widget($pager);
    }
}