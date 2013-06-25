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
        <td><?php echo $form->textField($user, 'name', array()); ?></td>
<!--        <td>--><?php //echo $form->error($user, 'name'); ?><!--</td>-->
    </tr>

    <tr>
        <td><?php echo $form->labelEx($user, 'surname'); ?></td>
        <td><?php echo $form->textField($user, 'surname', array()); ?></td>
<!--        <td>--><?php //echo $form->error($user, 'surname'); ?><!--</td>-->
    </tr>

    <tr>
        <td> <?php echo $form->labelEx($user, 'email'); ?></td>
        <td><?php echo $form->emailField($user, 'email', array()); ?></td>
<!--        <td>--><?php //echo $form->error($user, 'email'); ?><!--</td>-->
    </tr>

    <tr>
        <td><?php echo $form->labelEx($user, 'password'); ?></td>
        <td><?php echo $form->passwordField($user, 'password', array()); ?></td>
<!--        <td>--><?php //echo $form->error($user, 'password'); ?><!--</td>-->
    </tr>

    <tr>
        <td></td>
        <td><?php echo CHtml::submitButton('Зарегистироваться', array()); ?></td>
        <td></td>
    </tr>
</table>

<?php $this->endWidget(); ?>