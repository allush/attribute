<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php
    Yii::app()->clientScript->registerCssFile(
        CHtml::asset(Yii::app()->basePath . '/backend/assets/css/bootstrap.min.css')
    );

    Yii::app()->clientScript->registerScriptFile(
        CHtml::asset(Yii::app()->basePath . '/backend/assets/js/bootstrap.min.js'),
        CClientScript::POS_HEAD
    );
    ?>


</head>

<body>
<div class="row">
    <div class="span6 offset5">
        <?php echo $content; ?>

    </div>

</div>
</body>

</html>