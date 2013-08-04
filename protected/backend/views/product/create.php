<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Товары' => array('index'),
    'Добавление нового товара',
);

$this->renderPartial('_menu');
?>


<style type="text/css">@import url(/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/plupload/js/plupload.full.js"></script>

<script type="text/javascript" src="/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script type="text/javascript" src="/plupload/js/i18n/ru.js"></script>

<script type="text/javascript">

    // Convert divs to queue widgets when the DOM is ready
    $(function () {
        $("#uploader").pluploadQueue({
            // General settings
            runtimes: 'html5,gears,flash,silverlight,browserplus',
            url: '<?php echo $this->createUrl('upload')?>',
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
                YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken;?>'
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