<?php
/* @var $this ProductController ?> */
?>

<?php $this->beginContent('//layouts/default'); ?>

    <div id="line-blue">
        <div id="line-blue-wrap">
            <div id="menu-top">
                <div class="sort">
                    <span>Сортировать:</span>
                    <a href="javascript:void(0)" class="sort-button"></a>
                </div>
                <!--.sort-->
                <ul>
                    <li><?php echo CHtml::link('Все', array('/product/index'));?></li>
                    <li><?php echo CHtml::link('Новинки', array('/product/index', 'target' => 'new'));?></li>
                    <li><?php echo CHtml::link('Топ продаж', array('/product/index', 'target' => 'top'));?></li>
<!--                    <li>--><?php //echo CHtml::link('Акции', array('/action/index'));?><!--</li>-->
                </ul>
                <!--                    <div class="filter-colors">-->
                <!--                        <div class="filter-header">Фильтр по цветам</div>-->
                <!--                        <div class="colors">-->
                <!--                            <a href="javascript:void(0)" class="icon-color black"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color gray"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color light-pink"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color pink"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color red"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color blue"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color brown"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color yellow"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color orange"></a>-->
                <!--                            <a href="javascript:void(0)" class="icon-color green"></a>-->
                <!--                        </div>-->
                <!--                    </div>-->
            </div>
            <!--#menu-top-->

        </div>
        <!--#line-blue-wrap-->
    </div>


    <div class="left-sidebar">
        <div class="left-menu-top">
            <div class="left-menu-bottom">
                <div class="left-menu">
                    <ul>
                        <?php
                        foreach ($this->catalogs as $catalog) {
                            $active = '';
                            if (isset($_GET['c']) && $_GET['c'] == $catalog->catalogID)
                                $active = 'active';
                            echo '<li class="' . $active . '"><div class="li-wrap">' . CHtml::link($catalog->name, array('/product/index', 'c' => $catalog->catalogID)) . '</div></li>';
                        }
                        ?>
                    </ul>
                </div>
                <!--.left-menu-->
            </div>
            <!--.left-menu-bottom-->
        </div>
        <!--.left-menu-top-->
        <div class="socials">
            <p>Мы в социальных сетях:</p>
<!--            <a href="#" target="_blank" class="facebook-icon"></a>-->
<!--            <a href="#" target="_blank" class="twitter-icon"></a>-->
<!--            <a href="#" target="_blank" class="google-icon"></a>-->
            <a href="http://vk.com/club54960227" target="_blank" class="vk-icon"></a>

            <div class="clear"></div>
        </div>
    </div>
    <!--.left-sidebar-->
    <div class="right-content">
        <?php echo $content;?>
    </div>
    <!--.right-content-->

    <div class="clear"></div>

<?php $this->endContent(); ?>