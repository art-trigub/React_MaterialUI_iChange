<?php
use yii\bootstrap4\Html;
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>

<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    <?= Html::encode($this->title) ?>
                </h3>
            </div>
        </div>

    </div>
    <div class="m-portlet__body">
        <?= $content ?>
    </div>
</div>

<?php $this->endContent(); ?>
