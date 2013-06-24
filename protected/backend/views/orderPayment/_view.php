<?php
/* @var $this OrderPaymentController */
/* @var $data OrderPayment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderPaymentID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderPaymentID), array('view', 'id'=>$data->orderPaymentID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>