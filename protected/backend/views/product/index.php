<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */
/* @var $hierarchy array */

$this->breadcrumbs = array(
    'Товары',
);
$this->renderPartial('_menu');
?>
<div class="row">
    <div class="span2">
        <?php
        $this->widget('system.web.widgets.CTreeView', array(
            'data' => $hierarchy,
            'collapsed' => true,
            'unique' => true,
            'persist' => 'location',
            'animated' => 'fast'
        ));
        echo '<br>';

        // вычислить кол-во ноутовв линейке
        $productCount = Yii::app()->db->createCommand()
            ->select('COUNT(productID)')
            ->from('product')
            ->where('product.catalogID IS NULL')
            ->queryScalar();


        echo CHtml::link('Вне каталогов', array('index', 'c' => 0)) . ' <small>(' . $productCount . ')</small>';
        ?>
    </div>
    <div class="span10">
        <?php
        /** @var $form CActiveForm */
        $form = $this->beginWidget('CActiveForm', array(
            'action' => array('groupAction'),
            'id' => 'product-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(),
        ));
        echo '<button class="btn btn-small" name="action" value="group">Группировать</button>';
        echo '<button class="btn btn-small" name="action" value="ungroup">Разгруппировать</button>';

        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'itemsTagName' => 'table',
            'itemsCssClass' => 'table table-bordered table-condensed table-hover',

            'template' => '{summary}  {pager} {items} {pager}',
            'summaryText' => '{start} - {end} из {count}',
            'summaryCssClass' => 'pull-right',

            'pagerCssClass' => 'pagination',
            'pager' => array(
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
                'maxButtonCount' => '10',
                'header' => '',
                'cssFile' => '',
                'selectedPageCssClass' => 'active',
            ),
        ));

        $this->endWidget();
        ?>
    </div>
</div>