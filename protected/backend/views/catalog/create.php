<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Catalog', 'url'=>array('index')),
	array('label'=>'Manage Catalog', 'url'=>array('admin')),
);
?>

<h1>Create Catalog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>