<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'orderID'); ?>
		<?php echo $form->textField($model,'orderID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderStatusID'); ?>
		<?php echo $form->textField($model,'orderStatusID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdOn'); ?>
		<?php echo $form->textField($model,'createdOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'completedOn'); ?>
		<?php echo $form->textField($model,'completedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'executedOn'); ?>
		<?php echo $form->textField($model,'executedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderPaymentID'); ?>
		<?php echo $form->textField($model,'orderPaymentID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderDeliveryID'); ?>
		<?php echo $form->textField($model,'orderDeliveryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->