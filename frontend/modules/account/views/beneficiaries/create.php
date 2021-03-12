<?php

$this->params['breadcrumbs'][] = Yii::t('app', 'add new beneficiary');


?>

<!-- personal page headline -->
<div class="pers-headline container">
    <p class="pers-headline__title"><?= Yii::t('app', 'Add new beneficiary details') ?></p>
</div>
<!-- personal page headline end -->

<?= $this->render('_form', [
    'model' => $model,
]) ?>