<?php
/* @var $this ActionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Акции',
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
            'name' => 'header',
            'type' => 'raw',
            'value' => 'CHtml::link($data->header, array("update", "id" => $data->actionID))',
        ),
        'slogan',

        array(
            'name' => 'beginOn',
            'value'=>'date("d-m-Y", strtotime($data->beginOn))'
        ),
        array(
            'name' => 'endOn',
            'value'=>'date("d-m-Y", strtotime($data->endOn))'
        ),
    ),
    'showTableOnEmpty' => false,
    'emptyText' => 'У вас пока нет ни одной акции',
));
