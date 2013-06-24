<?php
/* @var $this OrderDeliveryController */
/* @var $model OrderDelivery */

$this->breadcrumbs=array(
	'Доставка'=>array('index'),
	$model->name=>array('view','id'=>$model->orderDeliveryID),
	'Редактирование',
);

$this->menu=array(
    array('label'=>'Назад', 'url'=>array('view', 'id'=>$model->orderDeliveryID)),
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Manage OrderDelivery', 'url'=>array('admin')),
);
?>

<h1>Update OrderDelivery <?php echo $model->orderDeliveryID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>