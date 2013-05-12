<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Twitter Bootstrap CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"
          media="screen"/>

    <link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.less"
          media="screen"/>


    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/less-1.3.3.min.js" type="text/javascript"></script>


</head>

<body>
<div class="row">
    <div class="span6 offset5">
        <?php echo $content; ?>

    </div>

</div>
</body>

</html>