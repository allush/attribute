<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs = array(
    'Акции' => array('index'),
    'Редактирование "' . $model->header . '"',
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
            'submit' => array('delete', 'id' => $model->actionID),
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        )
    ),
);

echo $this->renderPartial('_form', array('model' => $model)); ?>