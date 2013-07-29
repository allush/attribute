<?php
/* @var $this OrderDeliveryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Доставка',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name,array("update","id"=>$data->orderDeliveryID))'
        ),
        'price',
        array(
            'name' => 'hidden',
            'type' => 'raw',
            'value' => '($data->hidden == 0)?"Нет":"Да"'
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<i class=\"icon-remove icon-white\"></i>",
                array("#"),
                array(
                    "title" => "Удалить",
                    "class" => "btn btn-mini btn-danger",
                    "confirm" => "Вы уверены? У всех заказов с данным видом доставки поле \"Доставка\" станет \"Не определено\" ",
                    "submit" => array("delete", "id" => $data->orderDeliveryID),
                    "params" => array(
                        "YII_CSRF_TOKEN" => Yii::app()->request->csrfToken,
                    )
                ))',
        )
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
