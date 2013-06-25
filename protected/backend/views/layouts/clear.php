<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css'
          type='text/css'>
    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
</head>

<body>
<div class="row">
    <div class="span6 offset5">
        <?php echo $content; ?>

    </div>

</div>
</body>

</html>