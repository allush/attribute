<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
);

echo $this->renderPartial('_form', array('model' => $model));