<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Товары' => array('index'),
    '#' . $model->productID . ' ' . $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index', 'c' => $model->catalogID !== null ? $model->catalogID : -1)),
);
