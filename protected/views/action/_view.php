<?php
/* @var $this ActionController */
/* @var $data Action */
?>

<div>
    <p class="action-header">
        <?php echo CHtml::link($data->title, array('view', 'id' => $data->actionID)); ?>
    </p>

    <p>
        <?php echo CHtml::encode($data->description); ?>
    </p>

    <?php if (!is_null($data->expires)) { ?>
        <p>Продлится до:<?php echo CHtml::encode($data->expiresToStr()); ?></p>
    <?php } ?>

    <p>
        <?php echo CHtml::link(CHtml::image($data->picture()), array('view', 'id' => $data->actionID)); ?>
    </p>
</div>