<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Заказы',
);

$this->menu = array();

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'orderID',
        array(
            'name' => 'orderStatusID',
            'value' => '($data->orderStatus === null)?"-":$data->orderStatus->name'
        ),
        array(
            'name' => 'orderPaymentID',
            'value' => '($data->orderPayment === null)?"-":$data->orderPayment->name'
        ),
        array(
            'name' => 'orderDeliveryID',
            'value' => '($data->orderDelivery === null)?"-":$data->orderDelivery->name'
        ),
        array(
            'name' => 'userID',
            'value' => '($data->userID === null)?"-":$data->userID->name'
        ),
        array(
            'name' => 'createdOn',
            'value' => '($data->createdOn === null)?"-":date("d-m-Y",$data->createdOn)'
        ),
        array(
            'name' => 'modifiedOn',
            'value' => '($data->modifiedOn === null)?"-":date("d-m-Y",$data->modifiedOn)'
        ),
        array(
            'header' => 'Сумма',
            'value' => '$data->sum()'
        ),
        array(
            'header' => ' ',
            'type'=>'raw',
            'value' => 'CHtml::link("<i class=\"icon-remove icon-white\"></i>","",array("class"=>"btn btn-mini btn-danger"))'
        ),
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