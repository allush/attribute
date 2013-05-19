<?php
/* @var $this CatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Каталоги',
);


$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

$this->widget('system.web.widgets.CTreeView', array(
    'data' => $this->hierarchy(),
    'collapsed' => true,
    'unique' => true,
    'persist' => 'location',
    'animated' => 'fast'
));