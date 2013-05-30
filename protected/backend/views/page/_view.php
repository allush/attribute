<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="page">
    <?php echo ($index + 1) . '. ' . CHtml::link($data->name, array('update', 'id' => $data->pageID)); ?>
</div>