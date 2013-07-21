<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Товары' => array('index'),
    '#' . $model->productID . ' ' . $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index', 'c' => $model->catalogID !== null ? $model->catalogID : 0)),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'text-error',
            'submit' => array('delete', 'id' => $model->productID),
            'confirm' => 'Are you sure you want to delete this item?',
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        ),
        'itemOptions' => array('class' => 'pull-right')
    ),
);

$this->renderPartial('_form', array('model' => $model));