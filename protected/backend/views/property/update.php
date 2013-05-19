<?php
/* @var $this PropertyController */
/* @var $model Property */
/* @var $productID integer */

/** @var $product Product */
$product = Product::model()->findByPk($productID);

$this->breadcrumbs = array(
    'Товары' => array('/product/index'),
    '#' . $productID . ' ' . $product->name => array('product/view', 'id' => $productID),
    'Редактирование свойства "'.$model->name.'"',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('/product/view', 'id' => $productID))
);

echo $this->renderPartial('_form', array('model' => $model, 'productID' => $productID));