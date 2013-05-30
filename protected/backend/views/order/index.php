<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Заказы',
);

$this->menu = array(
    array('label' => 'Завершенные', 'url' => array('index')),
    array('label' => 'Незавершенные', 'url' => array('index')),
    array('label' => 'Выполненные', 'url' => array('index')),
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));