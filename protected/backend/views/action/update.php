<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs = array(
    'Акции' => array('index'),
    $model->title,
    'Редактирование',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'text-error',
            'submit' => array('delete', 'id' => $model->actionID),
            'confirm' => 'Вы уверены, что хотите удалить акцию?',
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        ),
        'itemOptions' => array('class' => 'pull-right')
    ),
);

echo $this->renderPartial('_form', array('model' => $model));