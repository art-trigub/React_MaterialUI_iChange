<?php

namespace backend\widgets;

use Closure;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Menu extends \yii\widgets\Menu
{
    /**
     * @var string the CSS class to be appended to the active menu item.
     */
    public $activeItemCssClass = 'm-menu__item--active';

    public $activeMenuCssClass = 'm-menu__item--open m-menu__item--expanded';

    public $options = [
        'class' => 'm-menu__nav  m-menu__nav--dropdown-submenu-arrow '
    ];

    public $submenuTemplate = "\n<div class=\"m-menu__submenu \" style=\"\" m-hidden-height=\"80\"><span class=\"m-menu__arrow\"></span><ul class=\"m-menu__subnav\">\n{items}\n</ul></div>\n";

    public $sectionTemplate = "<h4 class=\"m-menu__section-text\">{section}</h4><i class=\"m-menu__section-icon flaticon-more-v2\"></i>";

    public $sectionItemCssClass = 'm-menu__section';

    public $itemCssClass = 'm-menu__item ';

    public $menuVertical = true;

    public $menuScrollable = false;

    public $menuDropdownTimeout = 500;

    public $containerOptions = [
        'id' => 'm_ver_menu',
        'class' => 'm-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-scroller ps ps--active-y ',
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
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'ul');

            echo Html::beginTag('div', array_merge($this->containerOptions, [
                'm-menu-vertical' => (int)$this->menuVertical,
                'm-menu-scrollable' => (int)$this->menuScrollable,
                'm-menu-dropdown-timeout' => $this->menuDropdownTimeout
            ]));
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
            if ($item['active']) {
                $class[] = isset($item['items']) ? $this->activeMenuCssClass : $this->activeItemCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if(isset($item['section'])) {
                $class[] = $this->sectionItemCssClass;
                if($i === 0) {
                    $class[] = 'm-menu__section--first';
                }
            } else {
                $class[] = $this->itemCssClass;
            }

            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {

                Html::addCssClass($options, ['m-menu__item--submenu']);
                $options['m-menu-submenu-toggle'] = 'hover';
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
            $template = ArrayHelper::getValue($item, 'template', $this->getLinkTemplate($item, $bage));
            $replace = array_merge([
                '{url}' => Html::encode(Url::to($item['url'])),
                '{iconBefore}' => isset($item['icon']) ?
                    '<i class="m-menu__link-icon ' . $item['icon'] . '"></i>' :
                    '<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>',
                '{iconAfter}' => isset($item['items']) ? '<i class="m-menu__ver-arrow la la-angle-right"></i>' : '',
                '{class}'     => isset($item['items']) ? 'm-menu__toggle' : '',
                '{label}'     => $item['label'],
            ], $bage ? [
                '{bageType}'  => $item['bage']['type'],
                '{bageValue}' => $item['bage']['value']
            ] : []);

            return strtr($template, $replace);
        }

        if(isset($item['section'])) {

            return strtr($this->sectionTemplate, [
                '{section}' => $item['section'],
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }

    protected function getLinkTemplate($item, &$bage = false)
    {
        if(isset($item['bage']) && isset($item['bage']['type']) && isset($item['bage']['value'])) {
            $link = '<a class="m-menu__link {class}" href="{url}">
                    {iconBefore} 
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">{label}</span>
                                    <span class="m-menu__link-badge">
                                        <span class="m-badge m-badge--{bageType}">{bageValue}</span>
                                    </span>
                                </span>
                            </span>
                     {iconAfter} 
                     </a>';
            $bage = true;
        } else {
            $link = '<a class="m-menu__link {class}" href="{url}">
                        {iconBefore} 
                        <span class="m-menu__link-text">{label}</span>
                        {iconAfter} 
                    </a>';
        }

        return $link;
    }
}
