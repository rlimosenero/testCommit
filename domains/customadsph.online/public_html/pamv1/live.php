<?php
try{
	//$client = new SoapClient("https://myecpay.ph/WebService/wsbillpay/Service1.asmx?WSDL");
	//$AccountID='330';
	//$Username='TEST_CUSTOMIZED';
	//$Password='w0rdPas$';

	//$client = new SoapClient("https://s2s.OneECPay.com/wsbillpay/Service1.asmx?wsdl");

	$options = array(
		'soap_version'  => SOAP_1_2,
	'user_agent' => 'PHPSoapClient',
    'cache_wsdl' => 0,
    'trace' => 1,
	'encoding' => 'utf-8',
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
          )
    )));

$client = new SoapClient("https://s2s.OneECPay.com/wsbillpay/Service1.wsdl", $options);

	$AccountID='2293';
	$Username='ira.limosenero';
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