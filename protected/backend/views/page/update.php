<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs = array(
    'Страницы' => array('index'),
    'Редактирование "' . $model->name . '"',
);

$this->menu = array(
    array(
        'label' => 'Назад',
        'url' => array('index')
    ),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'itemOptions' => array('class' => 'pull-right'),
        'linkOptions' => array(
            'class' => 'text-error',
            'confirm' => 'Вы уверены?',
            'submit' => array('delete', 'id' => $model->pageID),
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        )
    ),
);

echo $this->renderPartial('_form', array('model' => $model)); ?>