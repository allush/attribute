<?php
/* @var $this ActionController */
/* @var $data Action */
?>

<div>

    <p><?php echo ($index+1).'. '.CHtml::link($data->title, array('update', 'id' => $data->actionID)); ?></p>

    <p><?php echo CHtml::link(CHtml::image($data->picture(), '',array('height' => 100)), array('update', 'id' => $data->actionID)); ?></p>


    <p><?php echo CHtml::encode($data->description); ?></p>

    <p>Продлится до: <?php echo CHtml::encode($data->expiresToStr()); ?></p>

</div>