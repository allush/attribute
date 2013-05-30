<?php
/* @var $this Controller ?> */
?>

<?php $this->beginContent('//layouts/main'); ?>

    <div class="left-sidebar">
        <div class="left-menu-top">
            <div class="left-menu-bottom">
                <div class="left-menu">
                    <ul>
                        <li>
                            <div class="li-wrap"><a href="#">Аксессуары для волос</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">iPhone чехлы/украшения</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Домашние носки и тапочки</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Кошельки</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Очки солнцезащитные</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Сумки</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Часы</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Шарфы</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Перчатки/варежки</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Зонты</a></div>
                        </li>
                        <li>
                            <div class="li-wrap"><a href="#">Головные уборы</a></div>
                        </li>
                    </ul>
                </div>
                <!--.left-menu-->
            </div>
            <!--.left-menu-bottom-->
        </div>
        <!--.left-menu-top-->
        <div class="socials">
            <p>Мы в социальных сетях:</p>
            <a href="#" class="facebook-icon"></a>
            <a href="#" class="twitter-icon"></a>
            <a href="#" class="google-icon"></a>
            <a href="#" class="vk-icon"></a>

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