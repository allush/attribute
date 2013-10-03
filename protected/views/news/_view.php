<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="action">
    <div class="action-header"><?php echo CHtml::link($data->header, array('view', 'id' => $data->newsID));?></div>
    <div class="action-content"><?php echo $data->trimmedContent();?></div>

    <?php
    if(strlen($data->content) > strlen($data->trimmedContent())){
        echo CHtml::link('читать полностью',array('view','id' => $data->newsID), array('class' => 'read-more-button'));
    }

    ?>
</div>