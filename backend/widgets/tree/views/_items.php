<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<ul class="<?=$listOptions['class'] ?>" <?php if($root): ?>id="<?=$this->context->options['id'];?>" <?php endif; ?>>
    <?php foreach ($models as $model): ?>
    <li class="tree-list__item" id="<?=$model->getPrimaryKey()?>">
        <div class="tree-list__row m-alert m-alert--air m-alert--square alert">

            <label class="tree-list__label">
                <?php if(isset($model->{$this->context->childsProperty}) && $model->{$this->context->childsProperty}): ?>
                    <i class="m-menu__ver-arrow la la-angle-right tree-list__arrow"></i>
                <?php endif; ?>
                <?php
                if($this->context->label instanceof Closure) {
                    echo call_user_func($this->context->label, $model);
                } else {
                    echo $model->name;
                }
                ?>

            </label>
            <div class="tree-list__buttons">
                <?= \backend\widgets\LangButtons::widget(ArrayHelper::merge([
                    'model'  => $model,
                    'languages' => $languages,
                ], ($root ?
                    ArrayHelper::getValue($this->context->rootOptions, 'langButtons', []) :
                    ArrayHelper::getValue($this->context->childOptions, 'langButtons', [])
                ))); ?>

                <?= \backend\widgets\tree\ActionButtons::widget(ArrayHelper::merge([
                     'model' => $model
                ], ($root ?
                    ArrayHelper::getValue($this->context->rootOptions, 'actionButtons', []) :
                    ArrayHelper::getValue($this->context->childOptions, 'actionButtons', [])
                ))); ?>
            </div>
        </div>
        <?php
        if(isset($model->{$this->context->childsProperty}) && $model->{$this->context->childsProperty})
            echo $this->context->renderItems($model->{$this->context->childsProperty});
        ?>
    </li>
    <?php endforeach; ?>
</ul>