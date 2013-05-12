<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->actionID=>array('view','id'=>$model->actionID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Action', 'url'=>array('index')),
	array('label'=>'Create Action', 'url'=>array('create')),
	array('label'=>'View Action', 'url'=>array('view', 'id'=>$model->actionID)),
	array('label'=>'Manage Action', 'url'=>array('admin')),
);
?>

<h1>Update Action <?php echo $model->actionID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>