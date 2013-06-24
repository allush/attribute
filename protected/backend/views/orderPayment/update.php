<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs = array(
    'Оплата' => array('index'),
    $model->name => array('view', 'id' => $model->orderPaymentID),
    'Редактировать',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : array('index')),
    array('label' => 'Создать', 'url' => array('create')),
);

echo $this->renderPartial('_form', array('model' => $model)); ?>