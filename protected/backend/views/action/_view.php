<?php
/* @var $this ActionController */
/* @var $data Action */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('actionID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->actionID), array('view', 'id'=>$data->actionID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('beginOn')); ?>:</b>
	<?php echo CHtml::encode($data->beginOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endOn')); ?>:</b>
	<?php echo CHtml::encode($data->endOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />


</div>