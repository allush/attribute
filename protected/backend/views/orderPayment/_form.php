<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'order-payment-form',
    'enableAjaxValidation' => false,
)); ?>

<div>
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>
