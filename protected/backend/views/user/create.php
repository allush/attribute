<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
);

echo $this->renderPartial('_form', array('model' => $model)); ?>