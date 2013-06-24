<?php
/* @var $this OrderDeliveryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Доставка',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
