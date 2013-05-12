<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productID), array('view', 'id'=>$data->productID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdOn')); ?>:</b>
	<?php echo CHtml::encode($data->createdOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productStatusID')); ?>:</b>
	<?php echo CHtml::encode($data->productStatusID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	*/ ?>

</div>