<?php
/* @var $this SiteController */
/* @var $model BackendLoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Вход';
$this->breadcrumbs = array(
    'Вход',
);
?>

<h1>Вход</h1>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'focus' => array($model, 'email'),
)); ?>

    <div>
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('class' => 'span3')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'span3')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="rememberMe">
        <?php echo $form->checkBox($model, 'rememberMe', array('style' => 'margin: 8px 8px 12px 0;')); ?>
        <?php echo $form->label($model, 'rememberMe', array('style' => 'display: inline;')); ?>
        <?php echo $form->error($model, 'rememberMe'); ?>
    </div>

    <div class="buttons">
        <?php echo CHtml::submitButton('Войти', array('class' => 'span3 btn')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
