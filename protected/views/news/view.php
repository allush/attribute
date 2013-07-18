<?php
/* @var $this NewsController */
/* @var $model News */

?>
<style type="text/css">
    .action {
        margin-bottom: 16px;
    }

    .action-header {
        margin-bottom: 4px;
        font-size: 18px;
    }

    .action-header a {
        color: #71c1cf;
    }
</style>

<div class="action">
    <div class="action-header"><?php echo $model->header;?></div>
    <div class="action-content">
        <?php echo $model->content;?>
    </div>
</div>