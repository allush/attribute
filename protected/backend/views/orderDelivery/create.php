<?php
/* @var $this OrderDeliveryController */
/* @var $model OrderDelivery */

$this->breadcrumbs=array(
	'Доставка'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Назад', 'url'=>array('index')),
);

echo $this->renderPartial('_form', array('model'=>$model)); ?>