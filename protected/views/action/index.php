<?php
/* @var $this ActionController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText' => ''
));

