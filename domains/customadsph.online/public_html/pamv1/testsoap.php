<?php


$soapUrl = " https://myecpay.ph/WebService/wsbillpay/";

$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body> 
<CheckBalance xmlns="http://tempuri.org/ECPNBillsPayment/Service1">
<AccountID>330</AccountID>
<Username>TEST_CUSTOMIZED</Username>
<Password>w0rdPas$</Password>
</CheckBalance>
</soap:Body>
</soap:Envelope>';

$headers = array("POST: /Service1.asmx HTTP/1.1","Host: myecpay.ph","Content-Type: text/xml; charset=utf-8","Content-Length: 434","SOAPAction: http://tempuri.org/ECPNBillsPayment/Service1/CheckBalance"
); 

$url = $soapUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch); 
curl_close($ch);
$response1 = str_replace("<soap:Body>","",$response);
$response2 = str_replace("</soap:Body>","",$response1);

$parser = simplexml_load_string($response2);

getPostString($parser);

   function getPostString($xmlPost) {
    echo strlen($xmlPost);
  }
?>