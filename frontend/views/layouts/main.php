<?php

use frontend\widgets\Breadcrumbs;

?>

<?php $this->beginContent('@frontend/views/layouts/base.php'); ?>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>


<?= $content; ?>

<?php $this->endContent(); ?>
