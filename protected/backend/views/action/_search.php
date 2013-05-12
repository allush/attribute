<?php
/* @var $this ActionController */
/* @var $model Action */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'actionID'); ?>
		<?php echo $form->textField($model,'actionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'picture'); ?>
		<?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beginOn'); ?>
		<?php echo $form->textField($model,'beginOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endOn'); ?>
		<?php echo $form->textField($model,'endOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->