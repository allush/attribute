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
                    'submit' => array('deletePicture', 'productPictureID' => $picture->productPictureID),
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
        ),
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
                'rows' => 11,
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
            <?php echo $form->labelEx($model, 'productNumber', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->textField($model, 'productNumber', array('class' => 'span2', 'title' => $model->getAttributeLabel('productStatusID')));
                echo $form->error($model, 'productNumber');
                ?>
            </div>
        </div>

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
                    array('class' => 'span2', 'title' => $model->getAttributeLabel('catalogID'), 'prompt' => '')
                );
                echo $form->error($model, 'catalogID');
                ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'unit', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'unit', array('class' => 'span2')); ?>
                <?php echo $form->error($model, 'unit'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'discount', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->numberField($model, 'discount', array(
                    'class' => 'span2',
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
                    'class' => 'span2',
                    'placeholder' => $model->getAttributeLabel('price'),
                    'title' => $model->getAttributeLabel('price'),
                ));
                echo $form->error($model, 'price');
                ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'purchase', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->numberField($model, 'purchase', array(
                    'class' => 'span2',
                    'placeholder' => $model->getAttributeLabel('purchase'),
                    'title' => $model->getAttributeLabel('purchase'),
                ));
                echo $form->error($model, 'purchase');
                ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'existence', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                echo $form->numberField($model, 'existence', array(
                    'class' => 'span2',
                    'placeholder' => $model->getAttributeLabel('existence'),
                    'title' => $model->getAttributeLabel('existence'),
                ));
                echo $form->error($model, 'existence');
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
                    runtimes:'html5,gears,flash,silverlight,browserplus',
                    url:'<?php echo $this->createUrl('uploadPicture', array('productID' => $model->productID))?>',
                    max_file_size:'8mb',
                    //            chunk_size: '1mb',
                    unique_names:true,
                    // Resize images on clientside if we can
                    resize:{width:1200, height:900, quality:90},
                    // Specify what files to browse for
                    filters:[
                        {title:"Image files", extensions:"jpg,jpeg,gif,png"},
                        {title:"Zip files", extensions:"zip"}
                    ],
                    multipart_params:{
                        YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken;?>'
                    },
                    // Flash settings
                    flash_swf_url:'/plupload/js/plupload.flash.swf',
                    // Silverlight settings
                    silverlight_xap_url:'/plupload/js/plupload.silverlight.xap'
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