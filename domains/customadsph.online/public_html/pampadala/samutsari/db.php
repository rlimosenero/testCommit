<?php
$server="localhost";
$userid ="u914242254_api_user";
$db_password = "godfirst";
$myDB = "u914242254_iglobe";

$eload = "https://s2s.OneECPay.com/wstopupv2/WSTopUp.asmx?wsdl";
$cashin = "https://s2s.OneECPay.com/wsecash/Service1.asmx?wsdl";
$signature = "";
$secretkey = "";
$bills = "https://s2s.OneECPay.com/wsbillpay/Service1.asmx?wsdl";
$username = "causer1";
$prod_password = "";
$prod_branchid = "";
$Host = 'myecpay.ph';
$Content_Type = 'text/xml; utf-8';

    try {
        $con = new PDO("mysql:host=$server;dbname=$myDB", $userid, $db_password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
