<?php
/* @var $this OrderController */
/* @var $order Order */


if (count($order->orderItems) == 0) {
    echo 'Корзина пуста';
}
?>
<table class="cart-table">
    <?php
    foreach ($order->orderItems as $orderItem) {
        $this->renderPartial('orderItem', array('orderItem' => $orderItem));
    }?>
    <tr class="noborder">
        <td></td>
        <td></td>
        <td></td>
        <td class="totalSum">Всего: <?php echo CHtml::encode($order->sum() . ' руб.');?></td>
        <td></td>
    </tr>
    <tr class="noborder">
        <td><?php echo CHtml::link('Вернуться к покупкам', '/product');?></td>
        <td></td>
        <td>
            <?php
            echo CHtml::link(
                'Очистить корзину',
                '#',
                array(
                    'submit' => array('clearOrder', 'orderID' => $order->orderID),
                    'confirm' => 'Вы уверены?',
                    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                )
            );
            ?>
        </td>
        <td><?php echo CHtml::link('Оформить заказ', array('orderCompletion'), array('class' => 'primary-btn'));?></td>
        <td></td>
    </tr>
</table>

<script type="text/javascript">
    $('.cart-quantity-input').change(function () {
        var totalSum = 0;
        $('.cart-quantity-input').each(function () {
            var cost = parseInt($(this).parent().parent().prev().html());
            totalSum += cost * parseFloat($(this).attr('value'));
            delete cost;
        });
        $('.totalSum').html('Всего: ' + totalSum + ' руб.');
        delete totalSum;
    });
</script>