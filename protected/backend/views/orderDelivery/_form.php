<?php
/* @var $this OrderDeliveryController */
/* @var $model OrderDelivery */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'order-delivery-form',
    'enableAjaxValidation' => false,
)); ?>

<div>
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
