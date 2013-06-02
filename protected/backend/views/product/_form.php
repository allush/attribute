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
                echo '<div class="span1">';
                echo CHtml::image($picture->thumbnail(), '');

                echo '<small>';
                echo CHtml::link('Удалить', '#', array(
                    'class' => 'text-error pull-right',
                    'submit' => array('deletePicture',  'productPictureID' => $picture->productPictureID),
                    'confirm' => 'Вы уверены?',
                    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                ));
                echo '</small>';

                echo '</div>';
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
                    array('class' => 'span2', 'title' => $model->getAttributeLabel('catalogID'),'prompt'=>'')
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

        <div class="control-group">
            <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->numberField($model, 'price', array(
                    'class' => 'span1',
                    'placeholder' => $model->getAttributeLabel('price'),
                    'title' => $model->getAttributeLabel('price'),
                ));
                echo $form->error($model, 'price');
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
                            array(
                                'label' => 'Добавить свойство',
                                'url' => array('/property/create', 'productID' => $model->productID),
                                'visible' => count($model->properties) < 3,
                                'linkOptions' => array('confirm' => 'Внимание! При добавлении нового свойства таблица наличия обнулится!'),
                            ),
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
                                    'confirm' => 'Вы уверены?',
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
                $propertyIDs = array();
                foreach ($model->properties as $property) {
                    $propertyIDs[] = $property->propertyID;
                }
                $propertyIDs = implode(',', $propertyIDs);

                $sql = '';
                switch (count($model->properties)) {
                    case 1:
                        $sql = 'SELECT  `t1`.`propertyItemID` as `propertyItemID1`, `t1`.`propertyID` as `propertyID1`
                                FROM    `propertyitem` AS `t1`
                                WHERE   `t1`.`propertyID` IN (' . $propertyIDs . ')
                                ORDER BY `t1`.`propertyItemID` ASC';
                        break;
                    case 2:
                        $sql = 'SELECT `t1`.`propertyItemID` as `propertyItemID1`, `t1`.`propertyID` as `propertyID1`, `t2`.`propertyItemID` as `propertyItemID2`, `t2`.`propertyID` as `propertyID2`
                                FROM  `propertyitem` AS `t1`
                                JOIN `propertyitem`  AS `t2` ON `t2`.`propertyID`>`t1`.`propertyID`
                                WHERE `t1`.`propertyID` IN (' . $propertyIDs . ') AND `t2`.`propertyID` IN (' . $propertyIDs . ')';
                        break;
                    case 3:
                        $sql = 'SELECT `t1`.`propertyItemID` as `propertyItemID1`, `t1`.`propertyID` as `propertyID1`, `t2`.`propertyItemID` as `propertyItemID2`, `t2`.`propertyID` as `propertyID2`, `t3`.`propertyItemID` as `propertyItemID3`, `t3`.`propertyID` as `propertyID3`
                                FROM  `propertyitem` AS `t1`
                                JOIN `propertyitem`  AS `t2` ON `t2`.`propertyID`>`t1`.`propertyID`
                                JOIN `propertyitem`  AS `t3` ON `t3`.`propertyID`>`t2`.`propertyID`
                                WHERE `t1`.`propertyID` IN (' . $propertyIDs . ') AND `t2`.`propertyID` IN (' . $propertyIDs . ') AND `t3`.`propertyID` IN (' . $propertyIDs . ')';
                        break;
                }

                if (strlen($sql) > 0) {
                    $command = Yii::app()->db->createCommand($sql);
                    $existenceTable = $command->query();
                } else {
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

<br>
<br>

<div class="row">
    <div class="span12">
        <h5>Добавление фото</h5>

        <style type="text/css">@import url(/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
        <!--        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->

        <!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
        <script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

        <!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
        <script type="text/javascript" src="/plupload/js/plupload.full.js"></script>

        <script type="text/javascript" src="/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script type="text/javascript" src="/plupload/js/i18n/ru.js"></script>

        <script type="text/javascript">

            // Convert divs to queue widgets when the DOM is ready
            $(function () {
                var uploader = $("#uploader").pluploadQueue({
                    // General settings
                    runtimes: 'html5,gears,flash,silverlight,browserplus',
                    url: '<?php echo $this->createUrl('uploadPicture',array('productID' => $model->productID))?>',
                    max_file_size: '8mb',
                    //            chunk_size: '1mb',
                    unique_names: true,
                    // Resize images on clientside if we can
                    resize: {width: 1200, height: 900, quality: 90},
                    // Specify what files to browse for
                    filters: [
                        {title: "Image files", extensions: "jpg,jpeg,gif,png"},
                        {title: "Zip files", extensions: "zip"}
                    ],
                    multipart_params: {
                        YII_CSRF_TOKEN: "<?php echo Yii::app()->request->csrfToken;?>"
                    },
                    // Flash settings
                    flash_swf_url: '/plupload/js/plupload.flash.swf',
                    // Silverlight settings
                    silverlight_xap_url: '/plupload/js/plupload.silverlight.xap'
                });

                // Client side form validation
                $('form').submit(function (e) {
                    var uploader = $('#uploader').pluploadQueue();
                    // Files in queue upload them first
                    if (uploader.files.length > 0) {
                        // When all files are uploaded submit form
                        uploader.bind('StateChanged', function () {
                            if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                                $('form')[0].submit();
                            }
                        });
                        uploader.start();
                    } else {
                        alert('You must queue at least one file.');
                    }
                    return false;
                });
            });
        </script>

        <form>
            <div id="uploader">
                <p>Ваш браузер не поддерживает ни одну из технологий: Flash, Silverlight, Gears, BrowserPlus, HTML5.</p>
            </div>
        </form>
    </div>
</div>