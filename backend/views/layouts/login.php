<?php
use yii\helpers\Html;
use backend\assets\MetronicAsset;
use backend\widgets\Alert;

MetronicAsset::register($this);


//$this->registerJsFile('/js/login.js',
//    ['depends' => [backend\assets\MetronicAsset::className()]]
//);
?>
<!DOCTYPE html>

<?php $this->beginPage() ?>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->






    <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />

    <?php $this->head() ?>
</head>
<!-- end::Head -->


<!-- begin::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<?php $this->beginBody() ?>


<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">


    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
        <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
            <div class="m-stack m-stack--hor m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid">

                    <div class="m-login__wrapper">

                        <div class="m-login__logo">
                            <a href="#">
                                <img src="/dist/metronic/images/logos/logo-2.png">
                            </a>
                        </div>

                        <?= Alert::widget() ?>

                        <?=$content;?>


                    </div>

                </div>

            </div>
        </div>

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" style="background-image: url(/dist/metronic/images/bg/bg-4.jpg)">
            <div class="m-grid__item">
                <h3 class="m-login__welcome">Bank</h3>
                <p class="m-login__msg">
                    Lorem ipsum dolor sit amet, coectetuer adipiscing<br>elit sed diam nonummy et nibh euismod
                </p>
            </div>
        </div>

    </div>


</div>
<!-- end:: Page -->


<?php $this->endBody() ?>
</body>
<!-- end::Body -->
</html>
<?php $this->endPage() ?>
