<?php
/* @var $this OrderDeliveryController */
/* @var $model OrderDelivery */

$this->breadcrumbs=array(
	'Доставка'=>array('index'),
    $model->name .' / Редактирование',
);

$this->menu=array(
    array('label'=>'Назад', 'url'=>array('index')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>