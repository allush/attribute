<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs=array(
	'Акции'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Назад', 'url'=>array('index')),
);

echo $this->renderPartial('_form', array('model'=>$model));