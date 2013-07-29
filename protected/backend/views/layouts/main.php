<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"
          media="screen"/>
    <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css'
          type='text/css'>
    <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.css'
          type='text/css'>

    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.js'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.edit.js'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
</head>

<body style="margin-top: 8px;">
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="navbar">
                <div class="navbar-inner">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Заказы', 'url' => array('/order/index')),
                            array('label' => 'Доставка', 'url' => array('/orderDelivery/index')),
                            array('label' => 'Оплата', 'url' => array('/orderPayment/index')),
                            array('label' => 'Товары', 'url' => array('/product/index')),
                            array('label' => 'Каталоги', 'url' => array('/catalog/index')),
                            array('label' => 'Страницы', 'url' => array('/page/index')),
                            array('label' => 'Пользователи', 'url' => array('/user/index')),
                            array('label' => '(' . Yii::app()->user->getState('login') . ') Выйти', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'separator' => '<span class="divider"> / </span> ',
                'tagName' => 'ul',
                'htmlOptions' => array(
                    'class' => 'breadcrumb'
                ),
            ));
            ?><!-- breadcrumbs -->
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'nav nav-pills'),
            ));
            ?>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <?php echo $content;?>
        </div>
    </div>
</div>

</body>
</html>
