<?php
/* @var $this ActionController */
/* @var $model Action */
/* @var $form CActiveForm */
?>

<div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'action-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
    )); ?>

    <div>
        <?php echo $form->labelEx($model, 'picture'); ?>
        <?php echo $form->fileField($model, 'picture', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'picture'); ?>
    </div>

    <div>
        <?php
        if (!$model->isNewRecord) {
            echo CHtml::image($model->picture());
        }
        ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'expires'); ?>
        <?php echo $form->dateField($model, 'expires', array('value' => ($model->isNewRecord ? '' : $model->expiresToStr()))); ?>
        <?php echo $form->error($model, 'expires'); ?>
    </div>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->