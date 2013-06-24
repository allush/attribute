<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs = array(
    'Оплата' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
);

echo $this->renderPartial('_form', array('model' => $model));