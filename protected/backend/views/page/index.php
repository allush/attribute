<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Страницы',
);

$this->menu = array(
);


if (Yii::app()->user->hasFlash('success')) {
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Поздравляем!</strong> <?php echo Yii::app()->user->getFlash('success');?>
    </div>
<?php
}

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'summaryText' => '{start} - {end} из {count}',
    'emptyText' => 'У вас пока нет ни одной страницы',
));
