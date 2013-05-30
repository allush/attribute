<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Страницы'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Назад', 'url'=>array('index')),
);

echo $this->renderPartial('_form', array('model'=>$model)); ?>