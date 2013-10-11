<?php
/* @var $this ActionController */
/* @var $model Action */
?>

<?php
echo CHtml::link('<= Все акции', array('index'), array('class' => 'read-more-button'));
?>

<div>
    <p class="action-header">
        <?php echo CHtml::link($model->title, array('view', 'id' => $model->actionID)); ?>
    </p>

    <p>
        <?php echo CHtml::link(CHtml::image($model->picture()), array('view', 'id' => $model->actionID)); ?>
    </p>

    <p>
        <?php echo CHtml::encode($model->description); ?>
    </p>

    <?php if (!is_null($model->expires)) { ?>
        <p>Продлится до:<?php echo CHtml::encode($model->expiresToStr()); ?></p>
    <?php } ?>

</div>