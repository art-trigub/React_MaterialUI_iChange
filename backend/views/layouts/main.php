<?php

use backend\assets\AppAsset;
use backend\widgets\Menu;
use backend\widgets\TopMenu;
use yii\bootstrap4\Breadcrumbs;
use backend\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Page;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$config = Yii::$app->jsConfig->get(true);

$script = <<< JS
    window.app = window.app || {};
    Object.assign(window.app, $config)

JS;

$this->registerJs($script,  yii\web\View::POS_HEAD);

?>
<!DOCTYPE html>

<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <?php $this->head() ?>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<?php $this->beginBody() ?>
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/" class="m-brand__logo-wrapper">
                                <img alt="" src="/dist/metronic/images/logos/logo-2.png" style="height:30px;">
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->


                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->


                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                            id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>


                    <?php
                    $topMenuItems = ArrayHelper::merge(Yii::$app->controller->topMenuItems, $this->topMenuItems);
                    if($topMenuItems) {
                        echo TopMenu::widget([
                            'items' => $topMenuItems
                        ]);
                    }
                    ?>

                    <!-- END: Horizontal Menu -->                                <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">


                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown"
                                    m-dropdown-persistent="1">

                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-icon"><i class="flaticon-search-1"></i></span>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
						<span class="m-list-search__form-input-wrapper">
							<input id="m_quicksearch_input" autocomplete="off" type="text" name="q"
                                   class="m-list-search__form-input" value="" placeholder="Search...">
						</span>
                                                        <span class="m-list-search__form-icon-close"
                                                              id="m_quicksearch_close">
							<i class="la la-remove"></i>
						</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable m-scroller ps"
                                                     data-scrollable="true" data-height="300" data-mobile-height="200"
                                                     style="height: 300px; overflow: hidden;">
                                                    <div class="m-dropdown__content">
                                                    </div>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0"
                                                             style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 4px;">
                                                        <div class="ps__thumb-y" tabindex="0"
                                                             style="top: 0px; height: 0px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                    m-dropdown-toggle="click" m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                        <span class="m-nav__link-icon"><i class="flaticon-alarm"></i></span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url(/dist/metronic/images/misc/notification_bg.jpg); background-size: cover;">
                                                <span class="m-dropdown__header-title">9 New</span>
                                                <span class="m-dropdown__header-subtitle">User Notifications</span>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand"
                                                        role="tablist">
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link active" data-toggle="tab"
                                                               href="#topbar_notifications_notifications" role="tab">
                                                                Alerts
                                                            </a>
                                                        </li>
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                                               href="#topbar_notifications_events" role="tab">Events</a>
                                                        </li>
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                                               href="#topbar_notifications_logs" role="tab">Logs</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active"
                                                             id="topbar_notifications_notifications" role="tabpanel">
                                                            <div class="m-scrollable m-scroller ps"
                                                                 data-scrollable="true" data-height="250"
                                                                 data-mobile-height="200"
                                                                 style="height: 250px; overflow: hidden;">
                                                                <div class="m-list-timeline m-list-timeline--skin-light">
                                                                    <div class="m-list-timeline__items">
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                            <span class="m-list-timeline__text">12 new users registered</span>
                                                                            <span class="m-list-timeline__time">Just now</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">System shutdown <span
                                                                                        class="m-badge m-badge--success m-badge--wide">pending</span></span>
                                                                            <span class="m-list-timeline__time">14 mins</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">New invoice received</span>
                                                                            <span class="m-list-timeline__time">20 mins</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">DB overloaded 80% <span
                                                                                        class="m-badge m-badge--info m-badge--wide">settled</span></span>
                                                                            <span class="m-list-timeline__time">1 hr</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">System error - <a
                                                                                        href="#"
                                                                                        class="m-link">Check</a></span>
                                                                            <span class="m-list-timeline__time">2 hrs</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span href="" class="m-list-timeline__text">New order received <span
                                                                                        class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
                                                                            <span class="m-list-timeline__time">7 hrs</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">Production server down</span>
                                                                            <span class="m-list-timeline__time">3 hrs</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">Production server up</span>
                                                                            <span class="m-list-timeline__time">5 hrs</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                    <div class="ps__thumb-x" tabindex="0"
                                                                         style="left: 0px; width: 0px;"></div>
                                                                </div>
                                                                <div class="ps__rail-y" style="top: 0px; right: 4px;">
                                                                    <div class="ps__thumb-y" tabindex="0"
                                                                         style="top: 0px; height: 0px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="topbar_notifications_events"
                                                             role="tabpanel">
                                                            <div class="m-scrollable m-scroller ps"
                                                                 data-scrollable="true" data-height="250"
                                                                 data-mobile-height="200"
                                                                 style="height: 250px; overflow: hidden;">
                                                                <div class="m-list-timeline m-list-timeline--skin-light">
                                                                    <div class="m-list-timeline__items">
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                            <a href="" class="m-list-timeline__text">New
                                                                                order received</a>
                                                                            <span class="m-list-timeline__time">Just now</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
                                                                            <a href="" class="m-list-timeline__text">New
                                                                                invoice received</a>
                                                                            <span class="m-list-timeline__time">20 mins</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                            <a href="" class="m-list-timeline__text">Production
                                                                                server up</a>
                                                                            <span class="m-list-timeline__time">5 hrs</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                            <a href="" class="m-list-timeline__text">New
                                                                                order received</a>
                                                                            <span class="m-list-timeline__time">7 hrs</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                            <a href="" class="m-list-timeline__text">System
                                                                                shutdown</a>
                                                                            <span class="m-list-timeline__time">11 mins</span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                            <a href="" class="m-list-timeline__text">Production
                                                                                server down</a>
                                                                            <span class="m-list-timeline__time">3 hrs</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                    <div class="ps__thumb-x" tabindex="0"
                                                                         style="left: 0px; width: 0px;"></div>
                                                                </div>
                                                                <div class="ps__rail-y" style="top: 0px; right: 4px;">
                                                                    <div class="ps__thumb-y" tabindex="0"
                                                                         style="top: 0px; height: 0px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="topbar_notifications_logs"
                                                             role="tabpanel">
                                                            <div class="m-stack m-stack--ver m-stack--general"
                                                                 style="min-height: 180px;">
                                                                <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                                                    <span class="">All caught up!<br>No new logs.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click" aria-expanded="true">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
	<span class="m-topbar__userpic">
		<img src="/images/avatar-375-456327.png" class="m--img-rounded m--marginless" alt="">
	</span>
                                        <span class="m-topbar__username m--hide">Nick</span>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 12.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: url(/dist/metronic/images/misc/user_profile_bg.jpg); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="/images/avatar-375-456327.png" class="m--img-rounded m--marginless" alt="">
                                                        <!--
                                                        <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>
                                                        -->
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">Mark Andre</span>
                                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">mark.andre@gmail.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
                                                            <span class="m-nav__section-text">Section</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="?page=header/profile&amp;demo=default" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
									<span class="m-nav__link-wrap">
										<span class="m-nav__link-text">My Profile</span>
										<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
									</span>
								</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="?page=header/profile&amp;demo=default" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">Activity</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="?page=header/profile&amp;demo=default" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">Messages</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="?page=header/profile&amp;demo=default" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">FAQ</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="?page=header/profile&amp;demo=default" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">Support</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <?php
                                                            if(!Yii::$app->user->isGuest) {
                                                                echo Html::beginForm(['/site/logout'], 'post');
                                                                echo Html::submitButton(
                                                                    'Logout',
                                                                    ['class' => 'btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder']
                                                                );
                                                                echo Html::endForm();
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->            </div>
            </div>
        </div>
    </header>            <!-- END: Header -->
    <!-- begin::Body -->
    <div id="app" class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->

            <?php
            echo Menu::widget([
                'activateParents' => true,
                'menuScrollable' => true,
                'items' => [

                    ['section' => 'Navigation'],

                    [
                        'label' => 'Currencies',
                        'icon' => 'fa fa-file-image',
                        'url' => 'javascript:;',
                        'active' => $this->context->section == 'currency',
                        'items' => [
                            [
                                'label' => 'List',
                                'icon' => 'fa fa-file-image',
                                'active' => $this->context->id == 'currency/list',
                                'url' => ['/currency/list']
                            ],
                            [
                                'label' => 'Icons',
                                'icon' => 'fa fa-file-image',
                                'active' => $this->context->id == 'currency/icons',
                                'url' => ['/currency/icons']
                            ],
                            [
                                'label' => 'Assets',
                                'icon' => 'flaticon-squares-2',
                                'active' => $this->context->id == 'currency/assets',
                                'url' => ['/currency/assets']
                            ],
                        ]
                    ],

                    [
                        'label' => 'Faq',
                        'icon' => 'fa fa-file-image',
                        'url' => 'javascript:;',
                        'active' => $this->context->section == 'faq',
                        'items' => [
                            [
                                'label' => 'Categories',
                                'icon' => 'fa fa-file-image',
                                'active' => $this->context->id == 'faq/category',
                                'url' => ['/faq/category']
                            ],
                            [
                                'label' => 'Items',
                                'icon' => 'flaticon-squares-2',
                                'active' => $this->context->id == 'faq/items',
                                'url' => ['/faq/items']
                            ],
                        ]
                    ],

                    [
                        'label' => 'Services',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'services',
                        'url' => ['/services/index']
                    ],

                    [
                        'label' => 'Countries',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'country',
                        'url' => ['/country/index']
                    ],

                    [
                        'label' => 'Transfer type',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'transfer-type',
                        'url' => ['/transfer-type/index']
                    ],

                    [
                        'label' => 'Transfer agent',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'transfer-agent',
                        'url' => ['/transfer-agent/index']
                    ],

                    [
                        'label' => 'Transfer country agent',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'transfer-country-agent',
                        'url' => ['/transfer-country-agent/index']
                    ],

//                    [
//                        'label' => 'Transfer pickup bank',
//                        //'icon' => 'fa fa-file-image',
//                        'active' => $this->context->id == 'transfer-pickup-bank',
//                        'url' => ['/transfer-pickup-bank/index']
//                    ],
//
//                    [
//                        'label' => 'Transfer money',
//                        //'icon' => 'fa fa-file-image',
//                        'active' => $this->context->id == 'transfer-money',
//                        'url' => ['/transfer-money/index']
//                    ],

                    [
                        'label' => 'Transfer money matrix',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'transfer-money-matrix',
                        'url' => ['/transfer-money-matrix/index']
                    ],


                    ['section' => 'Cards'],

                    [
                        'label' => 'Cards',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'cards',
                        'url' => ['/cards/index']
                    ],

					[
						'label' => 'Orders',
						//'icon' => 'fa fa-file-image',
						'active' => $this->context->id == 'card-order',
						'url' => ['/card-order/index']
					],

                    ['section' => 'Currency'],

                    [
                        'label' => 'Currency order',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'currency-order',
                        'url' => ['/currency-order/index']
                    ],

                    [
                        'label' => 'Transfer money request',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->id == 'transfer-money-request',
                        'url' => ['/transfer-money-request/index']
                    ],

                    ['section' => 'Clients'],

                    [
                        'label' => 'Users',
                        //'icon' => 'fa fa-file-image',
                        'active' => $this->context->section == 'user',
                        'url' => ['/user/default']
                    ],

                    ['section' => 'Design'],

                    [
                        'label' => 'Banners',
                        'icon' => 'flaticon-layers',
                        'url' => ['/banners']
                    ],

                    [
                        'label' => 'Slides',
                        'icon' => 'flaticon-layers',
                        'url' => ['/slider']
                    ],

                    ['section' => 'Content'],

                    [
                        'label' => 'Content Blocks',
                        'icon' => 'flaticon-layers',
                        'url' => ['/content-blocks']
                    ],

                    [
                        'label' => 'News',
                        'icon' => 'flaticon-layers',
                        'url' => ['/news']
                    ],

                    ['section' => 'Tools'],

                    [
                        'label' => 'Translate manager',
                        'active' => Yii::$app->controller->id == 'language',
                        'icon' => 'flaticon-app', 'url' => ['/translatemanager']
                    ],

                    [
                        'label' => 'Sitemap',
                        'active' => Yii::$app->controller->id == 'sitemap',
                        'icon' => 'flaticon-app',
                        'url' => ['/sitemap']
                    ],

                    [
                        'label' => 'Storage',
                        'active' => Yii::$app->controller->id == 'storage',
                        'icon' => 'flaticon-list-2',
                        'url' => ['/storage']
                    ],

                    [
                        'label' => 'Subscribtion',
                        'active' => Yii::$app->controller->id == 'subscribe',
                        'icon' => 'flaticon-app',
                        'url' => ['/subscribe']
                    ],

					[
						'label' => 'Blacklist',
						'active' => Yii::$app->controller->id == 'blacklist',
						'icon' => 'flaticon-app',
						'url' => ['/blacklist']
					],

                    ['section' => 'Pages'],

                    [
                        'label' => 'Rating',
                        'icon' => 'flaticon-notes',
                        'url' => ['/page-rating']
                    ],

                    [
                        'label' => 'Static',
                        //'active' => Yii::$app->controller->id == 'page' && in_array(Yii::$app->controller->action->id, ['main']),
                        'icon' => 'flaticon-notes',
                        'url' => 'javascript:;',
                        'items' => [
                            ['label' => 'Main', 'icon' => 'flaticon-notes', 'url' => ['/page/main']],
                            ['label' => 'Contacts', 'icon' => 'flaticon-notes', 'url' => ['/page/contacts']],
                            ['label' => 'About', 'icon' => 'flaticon-notes', 'url' => ['/page/about']],
                            ['label' => 'Currency order', 'icon' => 'flaticon-notes', 'url' => ['/page/currency-order']],
                        ]
                    ],

                    [
                        'label' => 'Tree',
                        'icon' => 'flaticon-notes',
                        'url' => 'javascript:;',
                        //'url' => ['/page/index'],
                        'items' => [
                            ['label' => 'All', 'icon' => 'flaticon-notes', 'url' => ['/page/index']],
                            ['label' => 'Header', 'icon' => 'flaticon-notes', 'url' => ['/page/tree', 'category' => Page::PAGE_CATEGORY_HEADER]],
                            ['label' => 'Footer', 'icon' => 'flaticon-notes', 'url' => ['/page/tree', 'category' => Page::PAGE_CATEGORY_FOOTER]],
                            ['label' => 'Bill Payments', 'icon' => 'flaticon-notes', 'url' => ['/page/tree', 'category' => Page::PAGE_CATEGORY_BILL_PAYMENTS]],
                        ]
                    ],

                    ['section' => 'Other'],

                    [
                        'label' => 'Slider',
                        'active' => in_array(Yii::$app->controller->id, ['slider']),
                        'icon' => 'flaticon-app',
                        'url' => ['/slider']
                    ],

                ],
            ]);
            ?>


            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
<!--                        <h3 class="m-subheader__title">-->
<!--                            --><?php //echo $this->title; ?>
<!--                        </h3>-->
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>

                        <? //= Alert::widget() ?>
                    </div>

                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2017 &copy; Metronic theme by
								<a href="https://keenthemes.com" class="m-link">
									Keenthemes
								</a>
							</span>
                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											About
										</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											Privacy
										</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											T&C
										</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
<!-- end::Quick Sidebar -->
<!-- begin::Scroll Top -->


<?php $this->endBody() ?>
</body>
<!-- end::Body -->
</html>
<?php $this->endPage() ?>
