<?php
/* @var $this OrderPaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Оплата',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>array(
        'name'
    ),
    'template' => '{summary}  {pager} {items} {pager}',
    'summaryText' => '{start} - {end} из {count}',
    'itemsCssClass' => 'table table-bordered table-condensed table-hover',
    'pagerCssClass' => 'pagination',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '10',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
    ),
));
