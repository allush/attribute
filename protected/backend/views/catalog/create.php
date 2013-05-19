<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
    'Каталоги'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Назад', 'url'=>array('index')),
);

echo $this->renderPartial('_form', array('model'=>$model));
