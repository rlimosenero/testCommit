<?php
try{
	//$client = new SoapClient("https://myecpay.ph/WebService/wsbillpay/Service1.asmx?WSDL");
	//$AccountID='330';
	//$Username='TEST_CUSTOMIZED';
	//$Password='w0rdPas$';

	$client = new SoapClient("https://s2s.OneECPay.com/wsbillpay/Service1.asmx?wsdl");




	$AccountID='2293';
	$Username='causer1';
	$Password='CustomAd$2014';

	$headerbody = array('CheckBalance'=>array('Host'=>'myecpay.ph','Content-Type'=>'text/xml;charset=utf-8')); 
	$header = new SoapHeader('https://s2s.OneECPay.com/wsbillpay/Service1','CheckBalance', $headerbody);       

//set the Headers of Soap Client.
	$client->__setSoapHeaders($header); 


// Soap call with HelloWorld() method
	$something =  $client->CheckBalance(array('AccountID' => $AccountID,'Username' => $Username,'Password'=>$Password));

// Convert object to array
	$array = (array)$something;
	echo json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}catch(Exception $e){
	echo $e->getMessage();
}


?>