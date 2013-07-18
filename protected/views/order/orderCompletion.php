<?php
/* @var $this OrderController */
/* @var $order Order */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/orderComplete.css');
?>
<div class="order-complete-form">
    <div class="heading">1. Адрес доставки</div>
    <?php
    $user = $order->user;
    if ($user->informationIsFull()) {
        echo $user->addressFull() . '<br>';
        ?>
        <div class="heading">2. Контакты</div>
        <?php
        echo $user->phone . '<br>';
        echo $user->email . '<br>';
    }

    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orderComplete-form',
        'enableAjaxValidation' => false,
        'action' => array('/order/complete', 'id' => $order->orderID),
        'htmlOptions' => array()
    ));
    ?>
    <div class="heading">3. Комментарий к заказу</div>
    <div>
        <?php echo $form->textArea($order, 'comment', array('class' => 'order-complete-comment')); ?>
        <?php echo $form->error($order, 'comment'); ?>
    </div>

    <div class="heading">4. Способ доставки</div>
    <div>
        <?php echo $form->radioButtonList($order, 'orderDeliveryID', CHtml::listData(OrderDelivery::model()->findAll(), 'orderDeliveryID', 'name'), array('required' => 'required')); ?>
        <?php echo $form->error($order, 'orderDeliveryID'); ?>
    </div>

    <div class="heading">5. Способ оплаты</div>
    <?php include_once(Yii::getPathOfAlias('application.views.order') . '/robokassa.php'); ?>

    <?php $this->endWidget(); ?>
</div>

<div class="order-complete-info">
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
                <td><?php echo CHtml::link($orderItem->product->name, array('/product/view', 'id' => $orderItem->productID));?></td>
                <td><?php echo $orderItem->product->price . ' руб';?></td>
                <td><?php echo $orderItem->quantity . ' ' . $orderItem->product->unit;?></td>
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
                    Всего: <?php echo CHtml::encode($order->sum() . ' руб.');?></td>
            </tr>
        <?php }?>
    </table>
</div>