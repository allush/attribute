<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'orderStatusID'); ?>
		<?php echo $form->textField($model,'orderStatusID'); ?>
		<?php echo $form->error($model,'orderStatusID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdOn'); ?>
		<?php echo $form->textField($model,'createdOn'); ?>
		<?php echo $form->error($model,'createdOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'completedOn'); ?>
		<?php echo $form->textField($model,'completedOn'); ?>
		<?php echo $form->error($model,'completedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'executedOn'); ?>
		<?php echo $form->textField($model,'executedOn'); ?>
		<?php echo $form->error($model,'executedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orderPaymentID'); ?>
		<?php echo $form->textField($model,'orderPaymentID'); ?>
		<?php echo $form->error($model,'orderPaymentID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orderDeliveryID'); ?>
		<?php echo $form->textField($model,'orderDeliveryID'); ?>
		<?php echo $form->error($model,'orderDeliveryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
		<?php echo $form->error($model,'userID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->