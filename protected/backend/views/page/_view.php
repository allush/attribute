<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pageID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pageID), array('view', 'id'=>$data->pageID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />


</div>