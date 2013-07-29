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
    <?php echo $form->labelEx($model, 'price'); ?>
    <?php echo $form->numberField($model, 'price', array('min' => 0, 'step' => 1)); ?>
    <?php echo $form->error($model, 'price'); ?>
</div>
<div>
    <?php echo $form->labelEx($model, 'hidden'); ?>
    <?php echo $form->checkBox($model, 'hidden'); ?>
    <?php echo $form->error($model, 'hidden'); ?>
</div>
<br>
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
