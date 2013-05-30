<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css">

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cycle.all.js"></script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/page_ini.js"></script>
</head>


<body>
<div id="container">
    <div id="header-container" class="index">
        <div id="header-wrapper">
            <div id="header">
                <div class="header-top">
                    <div id="header-logo">
                        <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/header_logo.png'), '/');?>
                    </div>
                    <!--.header-logo-->

                    <div id="header-right">
                        <a href="#" class="opt">Оптовые продажи</a>

                        <div class="header-phone">+7 948 949 49 30</div>
                    </div>
                    <!--.header-right-->
                    <div class="clear"></div>

                    <div class="header-menu-left">
                        <div class="header-menu-right">
                            <div class="header-menu">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array('label' => 'О нас', 'url' => array('/site/about'), 'linkOptions' => array('class' => 'about-us')),
                                        array('label' => 'Каталог', 'url' => array('/catalog/index'), 'linkOptions' => array('class' => 'catalog')),
                                        array('label' => 'Оплата и доставка', 'url' => array('/site/delivery'), 'linkOptions' => array('class' => 'delivery')),
                                        array('label' => 'Акции', 'url' => array('/action/index'), 'linkOptions' => array('class' => 'stock')),
                                        array('label' => 'Контакты', 'url' => array('/site/contacts'), 'linkOptions' => array('class' => 'contacts')),
                                        array('label' => '<input class="search-field" type="text" name="field"><input type="button" class="search-button" name="btn">', 'itemOptions' => array('class' => 'menu-search'))
                                    ),
                                    'encodeLabel' => false,
                                )); ?>
                                <div class="clear"></div>
                                <a href="#" class="basket">Корзина: <span class="count">0</span></a>
                                <a href="#" class="advanced-search">расширенный поиск</a>
                            </div>
                            <!--.header-menu-->
                        </div>
                        <!--.header-menu-right-->
                    </div>
                    <!--.header-menu-left-->

                    <div id="slider-container">
                        <a href="#" id="top-slider-prev"></a>
                        <a href="#" id="top-slider-next"></a>

                        <div id="slideshow-items">

                            <div class="slide">
                                <img src="images/slide_img_1.png">

                                <div class="slide-content">
                                    <div class="slide-header">Фотоконкурс</div>
                                    <span class="slide-slogan">Выигрывай ценные подарки за лучшую фотографию с нашими аксессуарами</span>
                                    <a href="#" class="want-button"></a>
                                </div>
                            </div>
                            <!--slide-->
                            <div class="slide">
                                <img src="images/slide_img_1.png">

                                <div class="slide-content">
                                    <div class="slide-header">конкурс</div>
                                    <span class="slide-slogan">Выигрывай ценные подарки за лучшую фотографию с нашими аксессуарами</span>
                                    <a href="#" class="want-button"></a>
                                </div>
                            </div>
                            <!--slide-->
                        </div>
                        <!--#slideshow-items-->
                        <div id="nav"></div>
                    </div>
                    <!--#slider-container-->
                </div>
                <!--.header-top-->
            </div>
            <!--#header-->
            <div class="top-wave"></div>
        </div>
        <!--#header-wrapper-->
    </div>

    <div id="content">
        <div id="line-blue">
            <div id="line-blue-wrap">
                <div id="menu-top">
                    <div class="sort">
                        <span>Сортировать:</span>
                        <a href="javascript:void(0)" class="sort-button"></a>
                    </div>
                    <!--.sort-->
                    <ul>
                        <li><a class="active" href="#">Все</a></li>
                        <li><a href="#">Новинки</a></li>
                        <li><a href="#">Топ-продаж</a></li>
                        <li><a href="#">Акции</a></li>
                    </ul>
                    <div class="filter-colors">
                        <div class="filter-header">Фильтр по цветам</div>
                        <div class="colors">
                            <a href="javascript:void(0)" class="icon-color black"></a>
                            <a href="javascript:void(0)" class="icon-color gray"></a>
                            <a href="javascript:void(0)" class="icon-color light-pink"></a>
                            <a href="javascript:void(0)" class="icon-color pink"></a>
                            <a href="javascript:void(0)" class="icon-color red"></a>
                            <a href="javascript:void(0)" class="icon-color blue"></a>
                            <a href="javascript:void(0)" class="icon-color brown"></a>
                            <a href="javascript:void(0)" class="icon-color yellow"></a>
                            <a href="javascript:void(0)" class="icon-color orange"></a>
                            <a href="javascript:void(0)" class="icon-color green"></a>
                        </div>
                    </div>
                </div>
                <!--#menu-top-->

            </div>
            <!--#line-blue-wrap-->
        </div>
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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.</p>

            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti
                atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum
                quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio
                cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est,
                omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus
                saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic
                tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis
                doloribus asperiores repellat.</p>

            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora
                incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum
                exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem
                vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum
                qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
        </div>
        <!--#footer-top-->
        <div id="footer-bottom">
            <div id="footer-menu-wrap">
                <div id="footer-menu">
                    <?php $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'О нас', 'url' => array('/')),
                            array('label' => 'Каталог', 'url' => array('/catalog/index')),
                            array('label' => 'Оплата и доставка', 'url' => array('/site/buy')),
                            array('label' => 'Акции', 'url' => array('/action/index')),
                            array('label' => 'Контакты', 'url' => array('/site/contacts')),
                        ),
                    )); ?>
                    <div class="footer-phone">+7 948 949 49 30</div>
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
