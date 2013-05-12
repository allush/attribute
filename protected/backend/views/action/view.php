<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->actionID,
);

$this->menu=array(
	array('label'=>'List Action', 'url'=>array('index')),
	array('label'=>'Create Action', 'url'=>array('create')),
	array('label'=>'Update Action', 'url'=>array('update', 'id'=>$model->actionID)),
	array('label'=>'Delete Action', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->actionID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Action', 'url'=>array('admin')),
);
?>

<h1>View Action #<?php echo $model->actionID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'actionID',
		'picture',
		'beginOn',
		'endOn',
		'position',
	),
)); ?>
