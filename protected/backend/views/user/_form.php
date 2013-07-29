<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
));
?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'surname', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'surname', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'surname'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'patronymic', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'patronymic', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'patronymic'); ?>
        </div>
    </div>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'index', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'index', array('class' => 'span5')); ?>
            <?php echo $form->error($model, 'index'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'country', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'country', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'country'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'region', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'region', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'region'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'sity', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'sity', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'sity'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'address', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'phone', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'activated', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'activated', array()); ?>
            <?php echo $form->error($model, 'activated'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'isAdmin', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'isAdmin', array()); ?>
            <?php echo $form->error($model, 'isAdmin'); ?>
        </div>
    </div>


    <div class="control-group">
        <div class="controls">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'span3 btn')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>