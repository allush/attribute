<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderID), array('view', 'id'=>$data->orderID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderStatusID')); ?>:</b>
	<?php echo CHtml::encode($data->orderStatusID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdOn')); ?>:</b>
	<?php echo CHtml::encode($data->createdOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderPaymentID')); ?>:</b>
	<?php echo CHtml::encode($data->orderPaymentID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDeliveryID')); ?>:</b>
	<?php echo CHtml::encode($data->orderDeliveryID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('userID')); ?>:</b>
	<?php echo CHtml::encode($data->userID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	*/ ?>

</div>