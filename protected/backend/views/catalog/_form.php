<?php
/* @var $this CatalogController */
/* @var $model Catalog */
/* @var $form CActiveForm */
?>

<div>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'catalog-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div>
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'span4',)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php
        $htmlOptions = array('class' => 'span4', 'prompt' => '');
        // если это каталог верхнего уровня и у него есть потомки, то запретить смену родительского каталога
        if ($model->parent === null && count($model->children()) > 0)
            $htmlOptions['disabled'] = 'disabled';

        $criteria = new CDbCriteria();
        // если каталог редактируется, то не показывать в качестве родительского каталога самого себя
        if (!$model->isNewRecord) {
            $criteria->condition = 'catalogID<>:catalogID';
            $criteria->params = array(':catalogID' => $model->catalogID);
        }

        echo $form->dropDownList($model, 'parent', CHtml::listData(Catalog::model()->findAll($criteria), 'catalogID', 'name'), $htmlOptions);
        echo $form->error($model, 'parent'); ?>
    </div>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->