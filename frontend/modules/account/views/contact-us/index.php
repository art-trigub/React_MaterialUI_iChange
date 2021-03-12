<?php

use frontend\widgets\ContactsFormWidget;

?>



<?= ContactsFormWidget::widget([
    'attributes' => Yii::$app->user->identity->getAttributes(['email', 'phone'])
]) ?>
