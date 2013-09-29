<?php
/* @var $this ProductController ?> */
?>

<?php $this->beginContent('//layouts/default'); ?>

    <div id="line-blue">
        <div id="line-blue-wrap">
            <div id="menu-top">
                <!--                <div class="sort">-->
                <!--                    <span>Сортировать:</span>-->
                <!--                    <a href="javascript:void(0)" class="sort-button"></a>-->
                <!--                </div>-->
                <!--.sort-->
                <ul>
                    <li><?php echo CHtml::link('Все', array('/product/index', 'c' => isset($_GET['c']) ? $_GET['c'] : 0)); ?></li>
                    <li><?php echo CHtml::link('Новинки', array('/product/index', 'c' => isset($_GET['c']) ? $_GET['c'] : 0, 'target' => 'new')); ?></li>
                    <li><?php echo CHtml::link('Топ продаж', array('/product/index', 'c' => isset($_GET['c']) ? $_GET['c'] : 0, 'target' => 'top')); ?></li>
                    <li><?php echo CHtml::link('Со скидкой', array('/product/index', 'c' => isset($_GET['c']) ? $_GET['c'] : 0, 'target' => 'sale')); ?></li>
                    <!--                    <li>-->
                    <?php //echo CHtml::link('Акции', array('/news/index'));?><!--</li>-->
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
                            /** @var Catalog[] $children */
                            $children = Catalog::model()->findAll(array(
                                'condition' => 'parent=' . $catalog->catalogID,
                                'order' => 'name ASC',
                            ));

                            $childrenID = array();
                            foreach ($children as $child) {
                                $childrenID[] = $child->catalogID;
                            }

                            $active = '';
                            if (isset($_GET['c']) && is_numeric($_GET['c']) && ($_GET['c'] == $catalog->catalogID || in_array($_GET['c'], $childrenID))) {
                                $active = 'active';
                            }
                            echo '<li class="' . $active . '">';

                            echo '<div class="li-wrap">' . CHtml::link($catalog->name, array('/product/index', 'c' => $catalog->catalogID)) . '</div>';


                            if (count($children) > 0) {
                                echo '<ul>';
                                foreach ($children as $child) {
                                    echo '<li>';

                                    $active = '';
                                    if (isset($_GET['c']) && is_numeric($_GET['c']) && $_GET['c'] == $child->catalogID) {
                                        $active = 'active';
                                    }
                                    echo CHtml::link($child->name, array('/product/index', 'c' => $child->catalogID), array('class' => "$active"));
                                    echo '</li>';

                                }
                                echo '</ul>';
                            }

                            echo '</li>';
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
            <a href="http://vk.com/attributepro" target="_blank" class="vk-icon"></a>
            <a href="http://instagram.com/p/eWqFlVOW73/" target="_blank" class="instagram-icon"></a>
            <a href="http://odnoklassniki.ru/group/51883095359682" target="_blank" class="odnoklassniki-icon"></a>

            <div class="clear"></div>
        </div>
    </div>
    <!--.left-sidebar-->
    <div class="right-content">
        <?php echo $content; ?>
    </div>
    <!--.right-content-->

    <div class="clear"></div>

<?php $this->endContent(); ?>