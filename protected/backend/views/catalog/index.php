<?php
/* @var $this CatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catalogs',
);

$this->menu=array(
	array('label'=>'Create Catalog', 'url'=>array('create')),
	array('label'=>'Manage Catalog', 'url'=>array('admin')),
);
?>

<h1>Catalogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
