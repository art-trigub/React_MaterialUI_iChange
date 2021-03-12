
<!-- personal page headline -->
<div class="pers-headline container">
    <p class="pers-headline__title"><?= Yii::t('app', 'edit beneficiary') ?></p>
</div>
<!-- personal page headline end -->

<?= $this->render('_form', [
    'model' => $model,
]) ?>