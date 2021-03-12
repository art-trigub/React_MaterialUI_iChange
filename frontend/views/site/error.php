<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>


<div class="container page-404">
    <div uk-grid="">
        <div class="uk-width-3-4@m">
            <div class="headline">
                <h1 class="headline__title"><?= $message ?></h1>
            </div>
            <div class="page-404__wrap">
                <div class="page-404__text">
                    <p><?= $exception->statusCode ?></p>
                    <p><?= Yii::t('app', 'Oops!') ?></p>
                </div>
                <div class="page-404__wrap-search">
                    <div class="search page-404__search">
                        <form class="search__form">
                            <div class="form-group">
                                <input class="input" type="text"
                                       placeholder="<?= Yii::t('app', 'Cards, transactions') ?>">
                            </div>
                            <button class="search__btn" type="submit">
                                <svg class="icon" width="16" height="16">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <a class="link link_blue-ud-line" href="<?= Url::to(['/']) ?>"><?= Yii::t('app', 'Go home') ?></a>
                </div>

            </div>

        </div>
    </div>
</div>


