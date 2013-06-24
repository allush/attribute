<?php
/* @var $this OrderPaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Оплата',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
