<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Пользователи',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'summaryText' => '{start} - {end} из {count}',
    'summaryCssClass' => 'pull-right',
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
    'columns' => array(
        array(
            'header' => 'ФИО',
            'name' => 'surname',
            'type' => 'raw',
            'value' => 'CHtml::link($data->surname." ".$data->name." ".$data->patronymic, array("update","id"=>$data->userID))',
        ),
        'email',
        'phone',
        array(
            'name' =>'activated',
            'value' => '($data->activated == 1)?"Да":"Нет"'
        ),
        array(
            'name' =>'isAdmin',
            'value' => '($data->isAdmin == 1)?"Да":"Нет"'
        ),
    ),

    'showTableOnEmpty' => false,
    'emptyText' => 'Нет ни одного пользователя',
));

