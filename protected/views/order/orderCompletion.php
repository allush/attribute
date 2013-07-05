<?php
/* @var $this OrderController */
/* @var $order Order */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/orderComplete.css');
?>
<div class="order-complete-form">
    <div class="heading">Адрес доставки</div>
    <?php
    $user = $order->user;
    if ($user->informationIsFull()) {
        echo $user->addressFull() . '<br>';
        ?>
        <div class="heading">Контакты</div>
        <?php
        echo $user->phone . '<br>';
        echo $user->email . '<br>';
    } else {
        ?>
        <div class="heading">Пожалуйста, заполните недостающую информацию</div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'incompleteInfo-form',
            'enableAjaxValidation' => true,
            'method' => 'post',
            'action' => array('/user/update', 'id' => $user->userID),
            'htmlOptions' => array()
        ));
        ?>
        <div>
            <?php echo $form->labelEx($user, 'surname', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'surname', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'surname'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'name', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'name'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'patronymic', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'patronymic', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'patronymic'); ?>
        </div>


        <div>
            <?php echo $form->labelEx($user, 'address', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'address'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'index', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'index', array('class' => 'span5')); ?>
            <?php echo $form->error($user, 'index'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'country', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'country', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'country'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'phone', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'phone', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'phone'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'region', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'region', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'region'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($user, 'sity', array('class' => 'control-label')); ?>
            <?php echo $form->textField($user, 'sity', array('class' => 'span5', 'maxlength' => 255)); ?>
            <?php echo $form->error($user, 'sity'); ?>
        </div>
        <?php

        $this->endWidget();
    }

    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orderComplete-form',
        'enableAjaxValidation' => true,
        'action' => array('/order/update', 'id' => $order->orderID),
        'htmlOptions' => array()
    ));
    ?>
    <div class="heading">Способ доставки</div>
    <div>
        <?php echo $form->radioButtonList($order, 'orderDeliveryID', CHtml::listData(OrderDelivery::model()->findAll(), 'orderDeliveryID', 'name'), array('required' => 'required')); ?>
        <?php echo $form->error($order, 'orderDeliveryID'); ?>
    </div>

    <div class="heading">Способ оплаты</div>
    <div>
        <?php echo $form->radioButtonList($order, 'orderPaymentID', CHtml::listData(OrderPayment::model()->findAll(), 'orderPaymentID', 'name'), array('required' => 'required', 'class' => 'orderPaymentRadio')); ?>
        <?php echo $form->error($order, 'orderPaymentID'); ?>
    </div>

    <div class="heading">Комментарий к заказу</div>
    <div>
        <?php echo $form->textArea($order, 'comment', array('class' => 'order-complete-comment')); ?>
        <?php echo $form->error($order, 'comment'); ?>
    </div>
    <?php $this->endWidget(); ?>


    <div class="robokassa" style="display: none;"></div>
    <script type="text/javascript">
        $('.orderPaymentRadio').change(function (e) {
            if (e.target.id == 'Order_orderPaymentID_1') {
                $.ajax({
                    url: '<?php echo $this->createUrl('robokassa');?>',
                    type: 'get',
                    data: {},
                    beforeSend: function () {
                        $('.robokassa').html('загрузка...');
                        $('.robokassa').show(200);
                    },
                    success: function (data) {
                        $('.robokassa').html(data);
                    }
                });
            } else {
                $('.robokassa').hide(200);
                $('.robokassa').html('');
            }
        });
    </script>

    <div>
        <?php echo CHtml::submitButton('Завершить оформление заказа', array('class' => 'primary-btn')); ?>
    </div>
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