<?php
/* @var $this PropertyItemController */
/* @var $model PropertyItem */
/* @var $form CActiveForm */
/* @var $propertyID integer */
?>

<div>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'property-item-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div>
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'span4')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <?php echo $form->hiddenField($model, 'propertyID', array('value' => $propertyID)); ?>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->