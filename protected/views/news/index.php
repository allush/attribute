<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
?>
    <style type="text/css">
        .action {
            margin-bottom: 16px;
        }

        .action-header {
            margin-bottom: 4px;
            font-size: 18px;
        }

        .action-header a {
            color: #71c1cf;
        }

        .action-content {

        }
    </style>

<?php

if(Yii::app()->user->hasFlash('activated') && Yii::app()->user->getFlash('activated') == true){
    echo '<div class="success-alert">Ваша  учетная запись активирована. Теперь Вы можете '.CHtml::link('войти', array('/site/signIn')).' в систему</div>';
}

if(Yii::app()->user->hasFlash('signUp') && Yii::app()->user->getFlash('signUp') == true){
    echo '<div class="success-alert">Вы успешно зарегистрированы. На вашу почту было выслано письмо с ссылкой для активации учетной записи</div>';
}

if(Yii::app()->user->hasFlash('questionSent') && Yii::app()->user->getFlash('questionSent') == true){
    echo '<div class="success-alert">Вопрос успешно отправлен.</div>';
}

?>

<script type="text/javascript">
    setTimeout(function(){
        $('.success-alert').fadeOut(200);
    },5000);
</script>

<?php


$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'summaryText' => '',
    'emptyText' => '',
));
