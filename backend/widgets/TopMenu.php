<?php

namespace backend\widgets;

use Closure;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class TopMenu extends \yii\widgets\Menu
{

    public $submenuTemplate = '<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       {items}
                                    </ul>
                                </div>';


    public $itemCssClass = 'm-menu__item ';

    public $listOptions = [
        'class' => 'm-menu__nav  m-menu__nav--submenu-arrow '
    ];

    public $containerOptions = [
        'id' => 'm_header_menu',
        'class' => 'm-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ',
    ];

    /**
     * Renders the menu.
     */
    public function run()
    {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);
        if (!empty($items)) {
            $options = $this->listOptions;
            $tag = ArrayHelper::remove($options, 'tag', 'ul');

            echo Html::beginTag('div', $this->containerOptions);
            echo Html::tag($tag, $this->renderItems($items), $options);
            echo Html::endTag('div');
        }
    }

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];

            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }

            $class[] = $this->itemCssClass;

            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {

                Html::addCssClass($options, ['m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown']);
                $options['m-menu-submenu-toggle'] = 'click';
                $options['m-menu-link-redirect'] = 1;
                $options['aria-haspopup'] = 'true';

                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->getLinkTemplate($item));
            $replace = [
                '{url}'   => Html::encode(Url::to($item['url'])),
                '{icon}'  => $item['icon'],
                '{label}' => $item['label'],
            ];

            return strtr($template, $replace);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }

    protected function getLinkTemplate($item)
    {
        if(isset($item['items'])) {
            $link = '<a href="{url}" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                    <i class="m-menu__link-icon {icon}"></i>
                                    <span class="m-menu__link-text">{label}</span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>';
        } else {
            $link = '<a href="{url}" class="m-menu__link ">
                        <i class="m-menu__link-icon {icon}"></i>
                        <span class="m-menu__link-text">{label}</span>
                     </a>';
        }

        return $link;
    }
}
