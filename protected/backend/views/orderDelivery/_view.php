<?php
/* @var $this OrderDeliveryController */
/* @var $data OrderDelivery */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDeliveryID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderDeliveryID), array('view', 'id'=>$data->orderDeliveryID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>