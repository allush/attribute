<?php
/* @var $this ActionController */
/* @var $model Action */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckeditor/ckeditor.js',
    CClientScript::POS_HEAD
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'action-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? array($model, 'name') : null,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
));
?>

<div>
    <?php echo $form->labelEx($model, 'header'); ?>
    <?php echo $form->textField($model, 'header', array('class' => 'span5')); ?>
    <?php echo $form->error($model, 'header'); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'slogan'); ?>
    <?php echo $form->textField($model, 'slogan', array('class' => 'span5')); ?>
    <?php echo $form->error($model, 'slogan'); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'beginOn'); ?>
    <?php echo $form->dateField($model, 'beginOn'); ?>
    <?php echo $form->error($model, 'beginOn'); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'endOn'); ?>
    <?php echo $form->dateField($model, 'endOn'); ?>
    <?php echo $form->error($model, 'endOn'); ?>
</div>

<div>
    <?php echo CHtml::image($model->picture());?>
</div>

<div>
    <?php echo $form->labelEx($model, 'picture'); ?>
    <?php echo $form->fileField($model, 'picture', array('class' => 'span5')); ?>
    <?php echo $form->error($model, 'picture'); ?>
</div>

<br>

<div>
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content'); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<br>

<div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>

<script>
    var editor = CKEDITOR.replace('Action[content]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>