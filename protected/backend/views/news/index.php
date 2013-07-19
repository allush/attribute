<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Новости',
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
            'value' => 'CHtml::link($data->header, array("update", "id" => $data->newsID))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<i class=\"icon-remove icon-white\"></i>",
                array("#"),
                array(
                    "title" => "Удалить",
                    "class" => "btn btn-mini btn-danger",
                    "confirm" => "Вы уверены?",
                    "submit" => array("delete", "id" => $data->newsID),
                    "params" => array(
                        "YII_CSRF_TOKEN" => Yii::app()->request->csrfToken,
                    )
                ))',
        )
    ),
    'hideHeader' => true,
    'showTableOnEmpty' => false,
    'emptyText' => 'У вас пока нет ни одной новости',
));
