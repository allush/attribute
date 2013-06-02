<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs = array(
    'Акции' => array('index'),
    'Редактирование "' . $model->header . '"',
);

$this->menu = array(
    array(
        'label' => 'Назад',
        'url' => array('index')
    ),
);

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
    <div class="action-header"><?php echo $model->header;?></div>
    <div class="action-slogan"><?php echo $model->slogan;?></div>
    <div class="action-end">
        <?php
        $time = (strtotime($model->endOn) - time());
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
        <?php echo CHtml::image($model->picture());?>
    </div>
    <div class="action-content">
        <?php echo $model->content;?>
    </div>
</div>