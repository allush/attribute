<style type="text/css">
    form[name=robokassa] {
        clear: both;
        margin: 0 4px 24px 4px;
    }

    form[name=robokassa] input[type=reset] {
        width: 140px;
        float: left;
        margin-top: 24px;
    }

    form[name=robokassa] input[type=submit] {
        width: 140px;
        float: right;
        margin-top: 24px;
    }

    label:after {
        background-color: #060606;
    }

    .groupCurrency {
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 4px;
        margin: 2px;
    }

    .groupCurrency:hover {
        cursor: pointer;
        background-image: url(images/all/gradient_ffcccc.png);
        border: 1px solid #ffcccc;
    }

    .groupCurrency_hover {
        background-image: url(images/all/gradient_ffcccc.png);
        border: 1px solid #ffcccc;
    }

    .currency {
        margin-left: 16px;
    }

    .currency input {
        margin: 4px;
    }

    label:hover {
        cursor: pointer;
    }

    .payment_type {
        margin: 4px;
        border: 1px solid #ddd;
        background-image: url(images/all/gradient_ddd.png);
        width: 365px;
        padding: 8px 0;
        font-size: 16pt;
        float: left;
        border-radius: 3px;
        text-align: center;
    }

    .payment_type:hover, .payment_type_active {
        cursor: pointer;
        border: 1px solid #ffcccc;
        background-image: url(images/all/gradient_ffcccc.png);
    }

    .clearer {
        clear: both;
    }

    fieldset.payment {
        border: 1px solid #dddddd;
        border-radius: 3px;
    }

    #pt_table {
    }

    #pt_table td label {
        margin-right: 24px;
    }
</style>

<?php
/* @var $this OrderController */
$order = $this->loadAuto();
$mrh_login = "attribute";
// сумма заказа
$out_summ = $order->sum();
// номер заказа
$inv_id = $order->orderID;
$mrh_pass1 = "attribute2013";
$shp_id_order = $order->orderID;
// кодировка
$encoding = "utf-8";

// формирование подписи
$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_id_order=$shp_id_order");

// описание заказа
$inv_desc = 'Оплата заказа № ' . $inv_id . ' на сайте attribute.pro';

// загрузки списка способов оплаты
$page = "";
$url = "http://test.robokassa.ru/Webservice/Service.asmx/GetCurrencies?MerchantLogin=" . $mrh_login . "&Language=ru";
//$url = "https://merchant.roboxchange.com/WebService/Service.asmx/GetCurrencies?MerchantLogin=claymake&Language=ru";
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
$page = curl_exec($c);
curl_close($c);
?>

<form id="robokassa" name="robokassa" action="http://test.robokassa.ru/Index.aspx" method="post">
    <input name="MrchLogin" type="hidden" value="<?php echo $mrh_login; ?>"/>
    <input name="OutSum" type="hidden" value="<?php echo $out_summ; ?>"/>
    <input name="InvId" type="hidden" value="<?php echo $inv_id; ?>"/>
    <input name="Desc" type="hidden" value="<?php echo $inv_desc; ?>"/>
    <input name="SignatureValue" type="hidden" value="<?php echo $crc; ?>"/>
    <input name="Encoding" type="hidden" value="<?php echo $encoding; ?>"/>
    <input name="shp_id_order" type="hidden" value="<?php echo $shp_id_order; ?>"/>

    <fieldset class="payment">
        <?php
        $xml = simplexml_load_string($page);
        foreach ($xml->Groups->Group as $group) {
            echo "<div class='groupCurrency' id='" . $group['Code'] . "' >" . $group['Description'] . "</div>";
            echo "<div class='currency' id='_" . $group['Code'] . "'>";
            foreach ($group->Items->Currency as $currency) {
                echo "<input name='IncCurrLabel' type='radio' required='required' value='" . $currency['Label'] . "' id='" . $group['Code'] . "_" . $currency['Label'] . "' />";
                echo " <label for='" . $group['Code'] . "_" . $currency['Label'] . "'>" . $currency['Name'] . "</label><br>";
            }
            echo "</div>";
        }
        ?>
    </fieldset>
    <button>Оплатить</button>
</form>

<script type="text/javascript">
    $(".currency").toggle();
    $(".groupCurrency").click(function () {
        $(".groupCurrency#" + this.id).toggleClass("groupCurrency_hover");
        $(".currency#_" + this.id).toggle();
    });
    $(".groupCurrency").first().click();
</script>