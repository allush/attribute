<?php
/* @var $this PropertyItemController */
/* @var $model PropertyItem */
/* @var $propertyID integer */

/** @var $property Property */
$property = Property::model()->findByPk($propertyID);

/** @var $product Product */
$product = Product::model()->findByPk($property->productID);

$this->breadcrumbs = array(
    'Товары' => array('/product/index'),
    '#' . $product->productID . ' ' . $product->name => array('product/view', 'id' => $product->productID),
    'Свойство "' . $property->name . '"' => array('/product/view', 'id' => $product->productID),
    'Создание значения'
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('/product/view', 'id' => $product->productID)),
);

echo $this->renderPartial('_form', array('model' => $model, 'propertyID' => $propertyID));