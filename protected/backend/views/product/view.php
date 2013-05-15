<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Товары' => array('index'),
    '#' . $model->productID . ' ' . $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->productID), 'confirm' => 'Are you sure you want to delete this item?')),
);

$this->renderPartial('_form', array('model' => $model)); ?>