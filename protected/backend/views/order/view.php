<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $orderItems CActiveDataProvider */

$this->breadcrumbs = array(
    'Заказы' => array('index'),
    'Заказ №' . $model->orderID,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->orderID),
            'confirm' => 'Вы уверены?',
            'class' => 'text-error'
        ),
        'itemOptions' => array(
            'class' => 'pull-right'
        )
    ),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'orderID',
        array(
            'name' => 'createdOn',
            'value' => ($model->createdOn === null) ? "-" : date("d-m-Y", $model->createdOn)
        ),
        array(
            'name' => 'modifiedOn',
            'value' => ($model->modifiedOn === null) ? "-" : date("d-m-Y", $model->modifiedOn)
        ),
        'orderPaymentID',
        'orderDeliveryID',

        array(
            'name' => 'userID',
            'value' => ($model->user !== null) ? $model->user->surname . ' ' . $model->user->name : 'Не задан',
        ),
        'comment',

        array(
            'name'=> 'orderStatusID',
            'type'=>'raw',
            'value' => CHtml::dropDownList(
                'orderStatusID',
                '',
                CHtml::listData(OrderStatus::model()->findAll(),'orderStatusID','name'),
                array()
            ),
        ),
    ),
    'htmlOptions' => array(
        'class' => 'table table-bordered table-condensed table-hover',
    )
)); ?>
<h4>Сумма заказа: <?php echo $model->sum(); ?> руб.</h4>
<h4 style="color: #ec211e;">Выручка: <?php echo $model->profit(); ?> руб.</h4>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $orderItems,
    'columns' => array(
        array(
            'header' => 'Картинка',
            'type' => 'raw',
            'value' => 'CHtml::image($data->product->thumbnail(),"",array("style"=>"width: 120px;"))'
        ),
        array(
            'header' => 'Название',
            'type' => 'raw',
            'value' => 'CHtml::link($data->product->name,array("/product/view","id"=>$data->product->productID))'
        ),
        array(
            'header' => 'Закупка',
            'value' => '$data->product->purchase." руб."'
        ),

        array(
            'header' => 'Стоимость',
            'value' => '$data->product->priceCurrency()'
        ),
        'quantity',
        array(
            'header' => 'Сумма',
            'value' => '($data->product->price() * $data->quantity)." руб."'
        ),
        array(
            'header' => 'Выручка',
            'value' => '(($data->product->price() - $data->product->purchase)* $data->quantity)." руб."'
        ),

    ),
    'template' => '{summary}  {pager} {items} {pager}',
    'summaryText' => '{start} - {end} из {count}',
    'itemsCssClass' => 'table table-bordered table-condensed table-hover',
    'pagerCssClass' => 'pagination',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '10',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
    ),
));