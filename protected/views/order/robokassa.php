<style type="text/css">
    label:hover {
        cursor: pointer;
    }

    .groupCurrency {
        border: 1px solid #cccccc;
        border-radius: 3px;
        padding: 4px;
        margin: 2px;
    }

    .groupCurrency:hover {
        cursor: pointer;
        border: 1px solid #a8d0da;
    }

    .currency {
        margin-left: 16px;
    }

    .currency input {
        margin: 4px;
    }

</style>

<?php
// загрузки списка способов оплаты
$mrh_login = "attribute";
$url = "http://test.robokassa.ru/Webservice/Service.asmx/GetCurrencies?MerchantLogin=" . $mrh_login . "&Language=ru";
//$url = "https://merchant.roboxchange.com/WebService/Service.asmx/GetCurrencies?MerchantLogin=claymake&Language=ru";
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
$page = curl_exec($c);
curl_close($c);

$xml = simplexml_load_string($page);
foreach ($xml->Groups->Group as $group) {
    echo "<div class='groupCurrency' id='" . $group['Code'] . "' >" . $group['Description'] . "</div>";
    echo "<div class='currency' id='_" . $group['Code'] . "'>";
    foreach ($group->Items->Currency as $currency) {
        echo "<input name='Robokassa[IncCurrLabel]' type='radio' required='required' value='" . $currency['Label'] . "' id='" . $group['Code'] . "_" . $currency['Label'] . "' />";
        echo " <label for='" . $group['Code'] . "_" . $currency['Label'] . "'>" . $currency['Name'] . "</label><br>";
    }
    echo "</div>";
}
?>

<script type="text/javascript">
    $(".currency").hide();
    $(".groupCurrency").click(function () {
        if ($(".currency#_" + this.id).is(':visible'))
            return;
        $(".currency").hide(200);
        $('.currency input[type=radio]').each(function () {
            $(this).attr('checked', false);
        });
        $(".currency#_" + this.id).show(200);
    });
    $(".groupCurrency").first().click();
</script>