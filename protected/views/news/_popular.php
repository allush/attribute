<?php
/* @var $this NewsController */
/* @var $data News */
?>
<p class="popular-news-item">
    <?php echo CHtml::link($data->header, array('view', 'id' => $data->newsID)); ?>
    <?php if ($data->numViews > 0) { ?>
        <span class="numViews"><?php echo $data->numViews; ?></span>
    <?php } ?>
</p>