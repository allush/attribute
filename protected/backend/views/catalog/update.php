<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs = array(
    'Каталоги' => array('index'),
    $model->name => array('view', 'id' => $model->catalogID),
    'Редактирование',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'text-error',
            'submit' => array('delete', 'id' => $model->catalogID),
            'confirm' => 'Вы уверены? Подкаталоги(если они есть) станут каталогами верхнего уровня, а все товары ДАННОГО каталога не будут привязаны ни к одному каталогу.',
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        ),
        'itemOptions' => array('class' => 'pull-right')
    ),
);

echo $this->renderPartial('_form', array('model' => $model));