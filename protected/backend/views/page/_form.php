<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckeditor/ckeditor.js',
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckfinder/ckfinder.js',
    CClientScript::POS_HEAD
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? array($model, 'name') : null,
));
?>

<div>
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('class' => 'span5')); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content', array('rows' => 6, 'class' => 'span5')); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<br>
<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn span2')); ?>
</div>

<?php $this->endWidget(); ?>


<script>
    var editor = CKEDITOR.replace('Page[content]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>