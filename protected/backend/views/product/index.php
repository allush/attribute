<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Товары',
);
$this->renderPartial('_menu');
?>
<div class="row">
    <div class="span2"></div>
    <div class="span10">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'itemsTagName' => 'table',
            'itemsCssClass' => 'table table-bordered table-condensed table-hover'
        ));
        ?>
    </div>
</div>