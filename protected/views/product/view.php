<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $relatedProducts Product[] */
/* @var $similarProducts Product[] */

$this->breadcrumbs = array(
    'Каталог' => array('index'),
    $model->catalog->name => array('index', 'c' => $model->catalogID !== null ? $model->catalogID : -1),
    $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index', 'c' => $model->catalogID !== null ? $model->catalogID : -1)),
);
?>

<div id="line-blue">
    <div id="line-blue-wrap">
        <?php
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'separator' => '<span class="arrow">></span>',
            'tagName' => 'div',
            'htmlOptions' => array(
                'class' => 'site-path'
            ),
        ));
        ?><!-- breadcrumbs -->
    </div>
    <!--#line-blue-wrap-->
</div><!--#line-blue-->

<div class="main-content">
    <div class="product-item">
        <div class="product-images">
            <div class="big-img-container">
                <?php echo CHtml::image($model->thumbnail(), '', array('class' => 'big-img')); ?>
            </div>
            <div class="gallery">
                <ul>
                    <?php
                    foreach ($model->pictures as $picture) {
                        echo '<li>' . CHtml::link(CHtml::image($picture->thumbnail()), 'javascript:void(0)') . '</li>';
                    }
                    ?>
                </ul>
                <div class="clear"></div>
            </div>
            <!--.gallery-->
        </div>
        <!--.product-images-->
        <div class="product-description">
            <h1><?php echo CHtml::encode($model->name); ?></h1>

            <p><?php echo CHtml::encode($model->description); ?></p>

            <div class="product-description-buttons">
                <?php if ($model->discount > 0) { ?>
                    <div style="margin-bottom: 20px;">
                        <span style="color: #FF622B;font-size: 18px;font-weight: bold; margin-right: 24px;" >Скидка <?php echo $model->discount;?>%</span>
                        <span style="color: #aaaaaa;font-size: 14px;font-weight: bold;">Старая цена: <?php echo $model->price.' руб.'?></span>
                    </div>

                <?php } ?>
                <div class="product-price"><?php echo CHtml::encode($model->priceCurrency()); ?></div>
                <?php echo CHtml::link('', '', array('class' => 'add-basket-button', 'productID' => $model->productID)); ?>
                <div class="clear"></div>
            </div>

            <?php if (count($similarProducts) > 0) { ?>

                <h1><?php echo CHtml::encode('Похожие товары'); ?></h1>
                <?php
                echo '<table style="width: 100%;">';
                foreach ($similarProducts as $oneSimilarProduct) {
                    echo '<tr>';
                    echo '<td>' . CHtml::link(CHtml::image($oneSimilarProduct->thumbnail(), '', array('style' => 'width: 100px;')), array('view', 'id' => $oneSimilarProduct->productID)) . '</td>';
                    echo '<td>' . CHtml::link($oneSimilarProduct->name, array('view', 'id' => $oneSimilarProduct->productID),array('style' => 'color: #333333;')) . '</td>';
                    echo '<td>' . $oneSimilarProduct->priceCurrency() . '</td>';
                    echo '<td>' . CHtml::link('', '', array('class' => 'to-basket-button-immediate', 'productID' => $oneSimilarProduct->productID)) . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            }
            ?>
        </div>
        <!--.product-description-->
        <div class="clear"></div>
    </div>
    <!--.product-item-->
    <div class="header-wrapper">
        <div class="header-wave-blue">
            <div class="header">
                <h2>С этим товаром покупают</h2>
            </div>
        </div>
    </div>
    <!--.header-wrapper-->
    <div class="products-line four-item">
        <?php
        foreach ($relatedProducts as $oneRelatedProduct) {
            echo '<div class="products-item">';
            echo '<div class="product-image">' . CHtml::link(CHtml::image($oneRelatedProduct->thumbnail()), array('view', 'id' => $oneRelatedProduct->productID)) . '</div>';
            echo '<div class="name-product">' . CHtml::link($oneRelatedProduct->name, array('view', 'id' => $oneRelatedProduct->productID), array('class' => '')) . '</div>';
            echo '<div class="product-price">';
            echo CHtml::link('', '', array('class' => 'to-basket-button', 'productID' => $oneRelatedProduct->productID));
            echo '<span>' . $oneRelatedProduct->priceCurrency() . '</span>';
            echo '</div>';

            echo '</div>';
        }
        ?>
        <div class="clear"></div>
    </div>
    <!--.products-line-->
</div><!--.main-content-->