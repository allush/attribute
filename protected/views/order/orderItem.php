<?php
/* @var $this OrderController */
/* @var $orderItem OrderItem */
?>

<tr>
    <td><?php echo CHtml::link(CHtml::image($orderItem->product->thumbnail(), '', array('class' => 'cart-thumbnail')), array('/product/view', 'id' => $orderItem->productID));?></td>
    <td><?php echo CHtml::link($orderItem->product->name, array('/product/view', 'id' => $orderItem->productID));?></td>
    <td><?php echo $orderItem->product->priceCurrency(); ?></td>
    <td>
        Количество<br>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action' => array('updateOrderItemQuantity', 'id' => $orderItem->orderItemID),
            'id' => 'orderItem' . $orderItem->orderItemID . '-form',
            'enableAjaxValidation' => true,
        ));
        echo CHtml::activeNumberField($orderItem, 'quantity', array(
            'class' => 'cart-quantity-input',
            'min' => 0,
            'max' => $orderItem->product->existence,
        ));
        echo $form->error($orderItem, 'quantity');
        $this->endWidget();
        ?>
    </td>
    <td>
        <?php
        echo CHtml::link(
            'х',
            '#',
            array(
                'class' => 'orderItem-delete',
                'title' => 'Убрать из корзины',
                'submit' => array('deleteOrderItem', 'id' => $orderItem->orderItemID),
                'confirm' => 'Вы уверены?',
                'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
            )
        );
        ?>
    </td>
</tr>
