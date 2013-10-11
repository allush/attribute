<?php
/* @var $this ActionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Акции',
);

$this->menu=array(
	array('label'=>'Создать акцию', 'url'=>array('create')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
