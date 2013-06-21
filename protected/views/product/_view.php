<?php
/* @var $this ProductController */
/* @var $data Product */
/* @var $itemCount int */


$closed = false;
if ($index % 3 == 0) {
    if ($index > 0) {
        echo '<div class="clear"></div>';
        echo '</div>';
        $closed = true;
    }
    $closed = false;
    echo '<div class="products-line three-item">';
}
?>

<div class="products-item">
    <div class="product-image">
        <?php echo CHtml::link(CHtml::image($data->image()), array('view', 'id' => $data->productID));?>
    </div>
    <div class="name-product">
        <?php echo CHtml::link($data->name, array('view', 'id' => $data->productID));?>
    </div>
    <div class="product-price">
        <?php
        echo CHtml::ajaxLink(
            '',
            array('/order/addToCart', 'productID' => $data->productID),
            array(
                'success' => 'js:function(data){
                                    if(data==301){
                                        document.location="' . $this->createUrl('/product/view', array('id' => $data->productID)) . '";
                                    } else{
                                        $(".basket .count").html(data);
                                    }
                              }',
            ),
            array('class' => 'to-basket-button')
        );
        ?>
        <span><?php echo $data->priceCurrency();?></span>
    </div>
    <!--    <a href="javascript:void(0)" class="new-icon"></a>-->
    <a href="javascript:void(0)" class="top-icon"></a>
</div>
<!--.products-item-->

<?php
if ($index + 1 == $itemCount && !$closed) {
    echo '<div class="clear"></div>';
    echo '</div>';
}

?>