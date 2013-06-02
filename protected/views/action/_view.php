<?php
/* @var $this ActionController */
/* @var $data Action */
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

    .action-slogan {
        font-size: 14px;
    }
</style>

<div class="action">
    <div class="action-header"><?php echo CHtml::link($data->header, array('view', 'id' => $data->actionID));?></div>
    <div class="action-slogan"><?php echo $data->slogan;?></div>
    <div class="action-end">
        <?php
        $time = (strtotime($data->endOn) - time());
        if ($time > 0) {
            $days = round($time / 60 / 60 / 24);
            $hours = round(($time - ($days * (60 * 60 * 24))) / (60 * 60));
            ?>
            Осталось
            <?php
            if ($days > 0) {
                echo $days . ' дн.';
            }
            if ($days == 0 && $hours > 0) {
                echo $hours . ' ч.';
            }
        } else {
            echo 'Акция завершилась';
        }?>
    </div>
    <div class="action-image">
        <?php echo CHtml::image($data->picture());?>
    </div>
</div>