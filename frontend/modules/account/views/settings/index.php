<?php

use common\widgets\Alert;
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>


<!-- personal page headline -->
<div class="pers-headline container">
    <p class="pers-headline__title"><?= Yii::t('app', 'Personal details') ?></p>
    <div class="pers-headline__wrap">
        <a href="#" class="link link_blue-ud-line pers-headline__link pers-headline__link_pen"><?= Yii::t('app', 'Change password') ?></a>
        <a href="#" class="link link_blue-ud-line pers-headline__link uk-hidden@m"><?= Yii::t('app', 'Cancel') ?></a>
    </div>
</div>
<!-- personal page headline end -->



