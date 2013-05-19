<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="span3">
        <?php echo CHtml::image($model->thumbnail(), '', array('id' => 'mainPicture'));?>
        <div class="row miniPicture">
            <?php
            foreach ($model->pictures as $picture) {
                echo '<div class="span1">' . CHtml::image($picture->thumbnail(), '') . '</div>';
            }
            ?>
        </div>
    </div>

    <script type="text/javascript">
        $('.miniPicture img').click(function () {
            $('#mainPicture').attr('src', $(this).attr('src'));
        });
    </script>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => array('update', 'id' => $model->productID),
        'id' => 'product-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        )
    ));
    ?>
    <div class="span5">
        <div>
            <?php
            echo $form->textField($model, 'name', array(
                'class' => 'span5',
                'placeholder' => $model->getAttributeLabel('name'),
                'title' => $model->getAttributeLabel('name'),
            ));
            echo $form->error($model, 'name');
            ?>
        </div>
        <br>

        <div>
            <?php
            echo $form->textArea($model, 'description', array(
                'rows' => 8,
                'class' => 'span5',
                'placeholder' => $model->getAttributeLabel('description'),
                'title' => $model->getAttributeLabel('description'),
            ));
            echo $form->error($model, 'description');
            ?>
        </div>
    </div>
    <div class="span4">
        <!--        <div>--><?php //echo 'Создан:' . date("H:i:s d/m/Y", $model->createdOn);?><!--</div>-->
        <!--        <div>--><?php //echo 'Изменен:' . date("H:i:s d/m/Y", $model->modifiedOn);?><!--</div>-->

        <div class="control-group">
            <?php echo $form->labelEx($model, 'productStatusID', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->dropDownList($model, 'productStatusID',
                    CHtml::listData(ProductStatus::model()->findAll(), 'productStatusID', 'name'),
                    array('class' => 'span2', 'title' => $model->getAttributeLabel('productStatusID'))
                );
                echo $form->error($model, 'productStatusID');
                ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'catalogID', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->dropDownList($model, 'catalogID',
                    CHtml::listData(Catalog::model()->findAll(), 'catalogID', 'name'),
                    array('class' => 'span2', 'title' => $model->getAttributeLabel('catalogID'))
                );
                echo $form->error($model, 'catalogID');
                ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'unit', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'unit', array('class' => 'span1')); ?>
                <?php echo $form->error($model, 'unit'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'discount', array('class' => 'control-label')); ?>
            <div class="controls">
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
    </div>
</div>
</div>
<?php $this->endWidget(); ?>
</div>

<br>
<br>

<div class="row">
    <div class="span12">
        <div class="row">
            <div class="span4">
                <h5>Свойства товара</h5>

                <div>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Добавить свойство', 'url' => array('/property/create', 'productID' => $model->productID), 'visible' => count($model->properties) < 3),
                        ),
                        'htmlOptions' => array('class' => 'nav nav-pills'),
                    ));
                    ?>
                </div>
                <ul>
                    <?php
                    foreach ($model->properties as $property) {
                        echo '<li>';
                        echo CHtml::link($property->name, array('/property/update', 'id' => $property->propertyID, 'productID' => $property->productID));
                        echo '<small>' . CHtml::link('Удалить', '#', array(
                            'class' => 'text-error pull-right',
                            'submit' => array(
                                '/property/delete', 'id' => $property->propertyID
                            ),
                            'confirm' => 'Вы уверены? Таблица, содержащая наличие товаров будет сброшена.',
                            'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                        )) . '</small>';

                        echo ' <small>' . CHtml::link('Создать значение', array('/propertyItem/create', 'propertyID' => $property->propertyID), array('class' => 'pull-right', 'style' => 'margin-right: 4px;')) . '</small>';

                        if (count($property->propertyItems)) {
                            echo '<ul>';
                            foreach ($property->propertyItems as $propertyItem) {
                                echo '<li>';
                                echo CHtml::link($propertyItem->name, array('/propertyItem/update', 'id' => $propertyItem->propertyItemID, 'propertyID' => $property->propertyID));
                                echo '<small>' . CHtml::link('Удалить', '#', array(
                                    'class' => 'text-error pull-right',
                                    'submit' => array(
                                        '/propertyItem/delete', 'id' => $propertyItem->propertyItemID
                                    ),
                                    'confirm' => 'Вы уверены? Таблица, содержащая наличие товаров будет сброшена.',
                                    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                                )) . '</small>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>

            <div class="span8">
                <h5>Наличие товара</h5>

                <?php
                $command = Yii::app()->db->createCommand();
                $command->reset();
                $existenceTable = $command->select('
                                        t1.propertyItemID as propertyItemID1,
                                        t1.propertyID as propertyID1,

                                        t2.propertyItemID as propertyItemID2,
                                        t2.propertyID as propertyID2,

                                        t3.propertyItemID as propertyItemID3,
                                        t3.propertyID as propertyID3')
                    ->from('propertyitem as t1, propertyitem as t2, propertyitem as t3')
                    ->where('property.productID=:productID AND t1.propertyID<t2.propertyID AND t2.propertyID<t3.propertyID AND t1.propertyID<t3.propertyID', array(':productID' => $model->productID))
                    ->order('t1.propertyItemID, t2.propertyItemID, t3.propertyItemID ASC')
                    ->query();

                if ($existenceTable->rowCount == 0) {
                    $command->reset();
                    $existenceTable = $command->select('
                                        t1.propertyItemID as propertyItemID1,
                                        t1.propertyID as propertyID1,

                                        t2.propertyItemID as propertyItemID2,
                                        t2.propertyID as propertyID2')
                        ->from('propertyitem as t1, propertyitem as t2')
                        ->where('t1.propertyID<t2.propertyID')
                        ->order('t1.propertyItemID, t2.propertyItemID ASC')
                        ->query();
                }
                if ($existenceTable->rowCount == 0) {
                    $command->reset();
                    $existenceTable = $command->select('
                                        t1.propertyItemID as propertyItemID1,
                                        t1.propertyID as propertyID1')
                        ->from('propertyitem as t1')
                        ->order('t1.propertyItemID ASC')
                        ->query();
                }

                // если все равно ничего не нашли, значит свойств нет
                if ($existenceTable->rowCount == 0) {
                    $existenceTable = array(array(
                        'productID' => $model->productID,
                    ));
                }

                $index = 0;
                foreach ($existenceTable as $row) {
                    $existence = Existence::model()->findByAttributes($row);
                    if ($existence === null) {
                        $existence = new Existence();
                        $existence->attributes = $row;
                        $existence->productID = $model->productID;
                        $existence->save();
                    }

                    if ($index == 0) {
                        echo '<div class="row">';
                        if (isset($row['propertyID1'])) {
                            echo '<div class="span2"><h6>' . Property::model()->findByPk($row['propertyID1'])->name . '</h6></div>';
                        }

                        if (isset($row['propertyID2'])) {
                            echo '<div class="span2"><h6>' . Property::model()->findByPk($row['propertyID2'])->name . '</h6></div>';
                        }
                        if (isset($row['propertyID3'])) {
                            echo '<div class="span2"><h6>' . Property::model()->findByPk($row['propertyID3'])->name . '</h6></div>';
                        }
                        echo '<div class="span2"><h6>Количество</h6></div>';
                        echo '</div>';
                    }


                    echo '<div class="row">';

                    /** @var $form1 CActiveForm */
                    $form1 = $this->beginWidget('CActiveForm', array(
                        'action' => array('setExistence', 'existenceID' => $existence->existenceID),
//                        'id' => 'product-form',
                        'enableAjaxValidation' => true,
                    ));

                    echo CHtml::hiddenField('Existence[productID]', $model->productID);
                    if (isset($row['propertyID1']) && isset($row['propertyItemID1'])) {
                        echo $form1->hiddenField($existence, 'propertyID1');
                        echo $form1->error($existence, 'propertyID1');
                        echo $form1->hiddenField($existence, 'propertyItemID1');
                        echo $form1->error($existence, 'propertyItemID1');
                        echo '<div class="span2">' . PropertyItem::model()->findByPk($row['propertyItemID1'])->name . '</div>';
                    }

                    if (isset($row['propertyID2']) && isset($row['propertyItemID2'])) {
                        echo $form1->hiddenField($existence, 'propertyID2');
                        echo $form1->error($existence, 'propertyID2');
                        echo $form1->hiddenField($existence, 'propertyItemID2');
                        echo $form1->error($existence, 'propertyItemID2');
                        echo '<div class="span2">' . PropertyItem::model()->findByPk($row['propertyItemID2'])->name . '</div>';
                    }
                    if (isset($row['propertyID3']) && isset($row['propertyItemID3'])) {
                        echo $form1->hiddenField($existence, 'propertyID3');
                        echo $form1->error($existence, 'propertyID3');
                        echo $form1->hiddenField($existence, 'propertyItemID3');
                        echo $form1->error($existence, 'propertyItemID3');
                        echo '<div class="span2">' . PropertyItem::model()->findByPk($row['propertyItemID3'])->name . '</div>';
                    }
                    echo '<div class="span2">' . $form1->numberField($existence, 'quantity', array('class' => 'span2')) . '</div>';
                    echo $form1->error($existence, 'quantity');
                    $this->endWidget();

                    echo '</div>';
                    $index++;
                }
                ?>
            </div>
        </div>
    </div>
</div>