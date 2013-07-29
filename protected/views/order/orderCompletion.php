<?php
/* @var $this OrderController */
/* @var $order Order */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/orderComplete.css');
?>
<div class="order-complete-form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orderComplete-form',
        'enableAjaxValidation' => false,
        'action' => array('/order/complete', 'id' => $order->orderID),
        'htmlOptions' => array()
    ));
    ?>
    <?php
    $user = $order->user;
    if ($user->informationIsFull()) {
        ?>
        <div class="heading">1. Адрес доставки</div>
        <?php
        echo $user->addressFull() . '<br>';
        echo $user->phone . '<br>';
        echo $user->email . '<br>';
    } else {
        ?>
        <div class="heading">1. Контакты. Пожалуйста, заполните недостающую информацию</div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('surname'), 'User[surname]', array()); ?>
            <?php echo CHtml::textField('User[surname]', $user->surname, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('name'), 'User[name]', array()); ?>
            <?php echo CHtml::textField('User[name]', $user->name, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('patronymic'), 'User[patronymic]', array()); ?>
            <?php echo CHtml::textField('User[patronymic]', $user->patronymic, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('country'), 'User[country]', array()); ?>
            <?php echo CHtml::textField('User[country]', $user->country, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('region'), 'User[region]', array()); ?>
            <?php echo CHtml::textField('User[region]', $user->region, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('sity'), 'User[sity]', array()); ?>
            <?php echo CHtml::textField('User[sity]', $user->sity, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('index'), 'User[index]', array()); ?>
            <?php echo CHtml::activeNumberField($user, 'index', array('min' => 0, 'max' => 999999, 'required' => 'required')); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('address'), 'User[address]', array()); ?>
            <?php echo CHtml::textField('User[address]', $user->address, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo CHtml::label($user->getAttributeLabel('phone'), 'User[phone]', array()); ?>
            <?php echo CHtml::textField('User[phone]', $user->phone, array('required' => 'required', 'maxlength' => 255)); ?>
        </div>
    <?php
    }
    ?>
    <div class="heading">2. Способ доставки</div>
    <div>
        <?php echo $form->radioButtonList($order, 'orderDeliveryID', CHtml::listData(OrderDelivery::model()->findAll(), 'orderDeliveryID', 'name'), array('required' => 'required')); ?>
        <?php echo $form->error($order, 'orderDeliveryID'); ?>
    </div>

    <div class="heading">4. Способ оплаты</div>
    <?php include_once(Yii::getPathOfAlias('application.views.order') . '/robokassa.php'); ?>

    <div class="heading">3. Комментарий к заказу</div>
    <div>
        <?php echo $form->textArea($order, 'comment', array('class' => 'order-complete-comment')); ?>
        <?php echo $form->error($order, 'comment'); ?>
    </div>

    <input type="submit" class="primary-btn" value="Оплатить и завершить">

    <?php $this->endWidget(); ?>
</div>


<div class="order-complete-info">
    <div class="heading">Содержание заказа</div>
    <table class="order-complete-table">
        <?php
        if (count($order->orderItems) > 0) {
            ?>
            <tr>
                <td>Название</td>
                <td>Стоимость</td>
                <td>Количество</td>
                <td>Сумма</td>
            </tr>
        <?php
        }

        foreach ($order->orderItems as $orderItem) {
            ?>
            <tr>
                <td><?php echo CHtml::link($orderItem->product->name, array('/product/view', 'id' => $orderItem->productID)); ?></td>
                <td><?php echo $orderItem->product->price . ' руб'; ?></td>
                <td><?php echo $orderItem->quantity . ' ' . $orderItem->product->unit; ?></td>
                <td><?php echo round($orderItem->quantity * $orderItem->product->price, 2) . ' руб'; ?></td>
            </tr>
        <?php
        }

        if (count($order->orderItems) > 0) {
            ?>
            <tr class="noborder">
                <td></td>
                <td></td>
                <td colspan="2" style="text-align: right; font-weight: bold;">
                    Всего: <?php echo CHtml::encode($order->sum() . ' руб.'); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>