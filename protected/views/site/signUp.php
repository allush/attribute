<?php
/* @var $this SiteController */
/* @var $user User */
/* @var $form CActiveForm */

?>

<h1>Регистрация</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action'=>array('/site/signUp'),
    'id' => 'signup-form',
    'enableAjaxValidation' => false,
    'focus' => array($user, 'name'),
    'htmlOptions' => array()
));
?>
<table>

    <tr>
        <td><?php echo $form->labelEx($user, 'name'); ?></td>
        <td><?php echo $form->textField($user, 'name', array('required'=>'required')); ?></td>
        <td><?php echo $form->error($user, 'name'); ?></td>
    </tr>

    <tr>
        <td> <?php echo $form->labelEx($user, 'email'); ?></td>
        <td><?php echo $form->emailField($user, 'email', array('required'=>'required')); ?></td>
        <td><?php echo $form->error($user, 'email'); ?></td>
    </tr>

    <tr>
        <td><?php echo $form->labelEx($user, 'password'); ?></td>
        <td><?php echo $form->passwordField($user, 'password', array('required'=>'required')); ?></td>
        <td><?php echo $form->error($user, 'password'); ?></td>
    </tr>

    <tr>
        <td><?php echo CHtml::submitButton('Зарегистироваться', array('style' => 'padding: 4px 16px;cursor: pointer;')); ?></td>
        <td><?php echo CHtml::link('Вход', array('signIn')); ?></td>
        <td></td>
    </tr>
</table>

<?php $this->endWidget(); ?>