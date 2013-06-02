<?php
/* @var $this ActionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Акции',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'summaryText' => '',
    'emptyText' => '',
));
