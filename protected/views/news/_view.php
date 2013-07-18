<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="action">
    <div class="action-header"><?php echo CHtml::link($data->header, array('view', 'id' => $data->newsID));?></div>
    <div class="action-content"><?php echo $data->content;?></div>
</div>