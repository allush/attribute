<?php
/* @var $this PropertyController */
/* @var $model Property */
/* @var $productID integer */
/* @var $form CActiveForm */
?>

<div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'property-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->hiddenField($model, 'productID', array('value' => $productID)); ?>

    <div>
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'span4')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->