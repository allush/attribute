<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Вход',
);
?>

<h1>Вход</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'focus' => array($model, 'email'),
));
?>
<table>
    <tr>
        <td><?php echo $form->labelEx($model, 'email'); ?></td>
        <td><?php echo $form->textField($model, 'email', array()); ?></td>
        <td><?php echo $form->error($model, 'email'); ?></td>
    </tr>

    <tr>
        <td><?php echo $form->labelEx($model, 'password'); ?></td>
        <td><?php echo $form->passwordField($model, 'password', array('class' => 'span3')); ?></td>
        <td><?php echo $form->error($model, 'password'); ?></td>
    </tr>

    <tr>
        <td><?php echo $form->label($model, 'rememberMe', array('style' => 'display: inline;')); ?></td>
        <td><?php echo $form->checkBox($model, 'rememberMe', array('style' => 'margin: 8px 8px 12px 0;')); ?></td>
        <td><?php echo $form->error($model, 'rememberMe'); ?></td>
    </tr>

    <tr>
        <td><?php echo CHtml::submitButton('Войти', array('class' => 'span3 btn', 'style' => 'padding: 4px 24px;cursor: pointer;')); ?> </td>
        <td><?php echo CHtml::link('Регистрация', array('signUp')); ?> </td>
        <td></td>
    </tr>
</table>

<?php $this->endWidget(); ?>
