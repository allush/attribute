<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
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
            'submit' => array('delete', 'id' => $model->newsID),
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        )
    ),
);

echo $this->renderPartial('_form', array('model' => $model)); ?>