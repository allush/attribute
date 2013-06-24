<?php
/* @var $this OrderPaymentController */
/* @var $model OrderPayment */

$this->breadcrumbs = array(
    'Оплата' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Редактировать', 'url' => array('update', 'id' => $model->orderPaymentID)),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array(
        'submit' => array('delete', 'id' => $model->orderPaymentID),
        'confirm' => 'Are you sure you want to delete this item?',
        'params' => array(
            'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
        )
    )),
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'orderPaymentID',
        'name',
    ),
));
