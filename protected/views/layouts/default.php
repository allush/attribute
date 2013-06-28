<?php
/* @var $this FrontController */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cart.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css">

    <?php Yii::app()->getClientScript()->registerCoreScript('jquery');?>
    <!--    <script type="text/javascript" src="-->
    <?php //echo Yii::app()->request->baseUrl; ?><!--/js/jquery-1.7.2.min.js"></script>-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cycle.all.js"></script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/page_ini.js"></script>
</head>


<body>
<div id="container">
    <div id="header-container">
        <div id="header-wrapper">
            <div id="header">
                <div class="header-top">
                    <div id="header-logo">
                        <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/img/header_logo.png'), '/');?>
                    </div>
                    <!--.header-logo-->

                    <div id="header-right">
                        <!--                        --><?php //echo CHtml::link('Оптовые продажи', array('/wholesale'), array('class' => 'opt'));?>

                        <div class="header-phone">8 937 411 10 20</div>
                    </div>
                    <!--.header-right-->
                    <div class="clear"></div>

                    <div class="header-menu-left">
                        <div class="header-menu-right">
                            <div class="header-menu">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                'items' => array(
                                    array('label' => 'О нас', 'url' => array('/about'), 'linkOptions' => array('class' => 'about-us')),
                                    array('label' => 'Каталог', 'url' => array('/product/index'), 'linkOptions' => array('class' => 'catalog')),
                                    array('label' => 'Оплата и доставка', 'url' => array('/delivery'), 'linkOptions' => array('class' => 'delivery')),
                                    array('label' => 'Акции', 'url' => array('/action/index'), 'linkOptions' => array('class' => 'stock')),
                                    array('label' => 'Контакты', 'url' => array('/contacts'), 'linkOptions' => array('class' => 'contacts')),
                                    array('label' => '<input placeholder="поиск" class="search-field" type="text" name="field"><input type="button" class="search-button" name="btn">', 'itemOptions' => array('class' => 'menu-search'))
                                ),
                                'encodeLabel' => false,
                            )); ?>
                                <div class="clear"></div>
                                <?php
                                echo CHtml::link('Корзина: <span class="count">' . $this->orderSum() . ' р.</span>', array('/cart'), array('class' => 'basket'));
                                ?>
                                <!--                                <a href="#" class="advanced-search">расширенный поиск</a>-->
                            </div>
                            <!--.header-menu-->
                        </div>
                        <!--.header-menu-right-->
                    </div>
                    <div id="login-status">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Вход', 'url' => array('/signIn'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Регистрация', 'url' => array('/signUp'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->user->getState('login'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Выход', 'url' => array('/signOut'), 'visible' => !Yii::app()->user->isGuest),
                            ),
                        ));
                        ?>
                    </div>
                    <!--.header-menu-left-->

                    <!--                    <div id="slider-container">-->
                    <!--                        <a href="#" id="top-slider-prev"></a>-->
                    <!--                        <a href="#" id="top-slider-next"></a>-->
                    <!---->
                    <!--                        <div id="slideshow-items">-->
                    <!---->
                    <!--                            <div class="slide">-->
                    <!--                                <img src="/images/slide_img_1.png">-->
                    <!---->
                    <!--                                <div class="slide-content">-->
                    <!--                                    <div class="slide-header">Фотоконкурс</div>-->
                    <!--                                    <span class="slide-slogan">Выигрывай ценные подарки за лучшую фотографию с нашими аксессуарами</span>-->
                    <!--                                    <a href="#" class="want-button"></a>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <!--slide-->
                    <!--                            <div class="slide">-->
                    <!--                                <img src="/images/slide_img_1.png">-->
                    <!---->
                    <!--                                <div class="slide-content">-->
                    <!--                                    <div class="slide-header">конкурс</div>-->
                    <!--                                    <span class="slide-slogan">Выигрывай ценные подарки за лучшую фотографию с нашими аксессуарами</span>-->
                    <!--                                    <a href="#" class="want-button"></a>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <!--slide-->
                    <!--                        </div>-->
                    <!--                        <!--#slideshow-items-->
                    <!--                        <div id="nav"></div>-->
                    <!--                    </div>-->
                    <!--                    <!--#slider-container-->
                </div>
                <!--.header-top-->
            </div>
            <!--#header-->
            <div class="top-wave"></div>
        </div>
        <!--#header-wrapper-->
    </div>

    <div id="content">

        <!--#line-blue-->
        <div class="main-content">

            <?php echo $content;?>
        </div>
        <!--.main-content-->
    </div>
    <!--#content-->
    <a href="#your-question" id="question"></a>

    <div style="display: none">
        <div id="your-question">
            <div class="your-question-bottom">
                <div class="your-question-body">
                    <div class="line-fields">
                        <label for="textarea">Ваш вопрос</label>
                        <textarea name="message" id="textarea"></textarea>
                    </div>
                    <div class="line-fields">
                        <label for="email">Ваш Email</label>
                        <input type="text" id="email" name="email" value="">
                    </div>
                    <div class="line-fields">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" name="name" value="">
                    </div>
                    <div class="send-button-container">
                        <div class="text">Спасибо!<br>В ближайшее время мы вышлем ответ вам на почту.</div>
                        <a href="javascript:void(0)" class="send-button"></a>

                        <div class="clear"></div>
                    </div>
                </div>
                <!--.your-question-body-->
            </div>
            <!--.your-question-bottom-->
        </div>
        <!--.your-question-->
    </div>
</div>
<!--#container-->
<div class="page-empty"></div>
<div id="footer-wrapper">
    <div id="footer">
        <div id="footer-top">
<!--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia-->
<!--                deserunt mollit anim id est laborum.</p>-->
<!---->
<!--            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti-->
<!--                atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,-->
<!--                similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum-->
<!--                quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio-->
<!--                cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est,-->
<!--                omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus-->
<!--                saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic-->
<!--                tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis-->
<!--                doloribus asperiores repellat.</p>-->
        </div>
        <!--#footer-top-->
        <div id="footer-bottom">
            <div id="footer-menu-wrap">
                <div id="footer-menu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'О нас', 'url' => array('/about')),
                            array('label' => 'Каталог', 'url' => array('/product/index')),
                            array('label' => 'Оплата и доставка', 'url' => array('/delivery')),
                            array('label' => 'Акции', 'url' => array('/action/index')),
                            array('label' => 'Контакты', 'url' => array('/contacts')),
                        ),
                    ));
                    ?>
                    <div class="footer-phone">8 937 411 10 20, 8 937 411 10 18</div>
                </div>
                <!--#footer-menu-->
            </div>
            <!--#footer-menu-wrap-->
            <div id="footer-icons">
                <div class="footer-left">
                    <p>Способы оплаты:</p>
                    <a href="#" class="visa-icon"></a>
                    <a href="#" class="master-icon"></a>
                    <a href="#" class="jsb-icon"></a>
                    <a href="#" class="diners-icon"></a>

                    <div class="clear"></div>
                </div>
                <div class="footer-right">
                    2013 © attribute.pro
                    <div class="socials-icons">
                        <a href="#" class="vk-icon"></a>
                        <a href="#" class="google-icon"></a>
                        <a href="#" class="twitter-icon"></a>
                        <a href="#" class="facebook-icon"></a>

                        <div class="clear-right"></div>
                    </div>
                </div>
                <div class="clear-both"></div>
            </div>
            <!--#footer-icons-->
        </div>
        <!--#footer-bottom-->
    </div>
    <!--#footer-->
</div>
<!--#footer-wrapper-->

</body>
</html>
