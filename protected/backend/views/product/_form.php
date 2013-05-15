<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="span3">
        <?php echo CHtml::image($model->thumbnail());?>
        Миниатюры
    </div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => array('update', 'id' => $model->productID),
        'id' => 'product-form',
        'enableAjaxValidation' => true,
    ));
    ?>
    <div class="span9">
        <div class="row">
            <div class="span4">
                <div class="row">
                    <div class="span2"><small><?php echo 'Создан:' . date("H:i:s d/m/Y", $model->createdOn);?></small></div>
                    <div class="span2"><small><?php echo 'Изменен:' . date("H:i:s d/m/Y", $model->modifiedOn);?></small></div>
                </div>
                <div>
                    <?php
                    echo $form->textField($model, 'name', array(
                        'class' => 'span4',
                        'placeholder' => $model->getAttributeLabel('name'),
                        'title' => $model->getAttributeLabel('name'),
                    ));
                    echo $form->error($model, 'name');
                    ?>
                </div>

                <div>
                    <?php
                    echo $form->textArea($model, 'description', array(
                        'rows' => 6,
                        'class' => 'span4',
                        'placeholder' => $model->getAttributeLabel('description'),
                        'title' => $model->getAttributeLabel('description'),
                    ));
                    echo $form->error($model, 'description');
                    ?>
                </div>
                <div class="row">
                    <div class="span1">
                        <?php echo $form->textField($model, 'unit', array('class' => 'span1', 'placeholder' => $model->getAttributeLabel('unit'), 'title' => $model->getAttributeLabel('unit'))); ?>
                        <?php echo $form->error($model, 'unit'); ?>
                    </div>
                    <div class="span1">
                        <div>
                            <?php
                            echo $form->numberField($model, 'discount', array(
                                'class' => 'span1',
                                'placeholder' => $model->getAttributeLabel('discount'),
                                'title' => $model->getAttributeLabel('discount'),
                                'min' => 0,
                                'max' => '100',
                                'step' => 1
                            ));
                            echo $form->error($model, 'discount');
                            ?>
                        </div>
                    </div>
                    <div class="span2">
                        <div>
                            <?php
                            echo $form->dropDownList($model, 'productStatusID',
                                CHtml::listData(Productstatus::model()->findAll(), 'productStatusID', 'name'),
                                array('class' => 'span2', 'title' => $model->getAttributeLabel('productStatusID'))
                            );
                            echo $form->error($model, 'productStatusID');
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span5">
                Кол-во
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <div class="span12">
        Свойства товара
    </div>
</div>