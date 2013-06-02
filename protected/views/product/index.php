<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */
/* @var $hierarchy array */

$this->breadcrumbs = array(
    'Товары',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'viewData' => array(
        'itemCount' => $dataProvider->itemCount,
    ),
    'template' => '{items} {pager}',
    'summaryText' => '',
    'pagerCssClass' => 'pager',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '7',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
    ),
));
?>
<script type="text/javascript">
    $('.to-basket-button').click(function(){
        return false;
    });
</script>
