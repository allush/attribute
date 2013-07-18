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
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'summaryText' => '',
    'emptyText' => '',
));
