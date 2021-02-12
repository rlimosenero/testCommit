<?php

try {


    //used to test url is usable
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?wsdl");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $curlresult=curl_exec ($ch);
    curl_close ($ch);
    
    
    var_dump($curlresult);
    if (preg_match("/OK/i", $curlresult)) {
        $result = "The curl action was succeeded! (OUTPUT of curl is: ".$curlresult.")";
    } else {
        $result = "The curl action has FAILED! (OUTPUT of curl is: ".$curlresult.")";
    }
    
    echo $result;
    // end of test

    
    
    
    
//     $options = array(
//         'soap_version' => SOAP_1_2,
//         'exceptions'   => true,
//         'trace'        => 1,
//         'cache_wsdl'   => WSDL_CACHE_NONE,
//         'encoding' => 'UTF-8'
//     );
///     $client = new SoapClient('https://s2s.oneecpay.com/wsbillpay/service1.asmx?WSDL', $options);
    
    
    
    
//     $headerbody = array('GetBillerList'=>array('Host'=>'myecpay.ph','Content-Type'=>'text/xml; utf-8'));
//     $header = new SoapHeader('http://tempuri.org/ECPNBillsPayment/Service1','GetBillerList', $headerbody);
    

    
    
//     $options = [
//         'cache_wsdl'     =>  WSDL_CACHE_NONE,
//         'trace'          => 1,
//         'stream_context' => stream_context_create(
//             [
//                 'ssl' => [
//                     'verify_peer'       => false,
//                     'verify_peer_name'  => false,
//                     'allow_self_signed' => true
//                 ]
//             ]
//             ),
//         'Content-Type' => 'text/application; utf-8',
//         'user_agent' => 'PHPSoapClient',
//         'Host' => 'myecpay.ph'
//     ];
//     libxml_disable_entity_loader(false);
//     $client = new SoapClient('https://s2s.oneecpay.com/wsbillpay/service1.asmx?WSDL', $options);
//         //set the Headers of Soap Client.
//     $client->__setSoapHeaders($header); 

    
    
    
    
    
    
//     $opts = array(
//         'http' => array(
//             'user_agent' => 'PHPSoapClient'
//         )
//     );
//     $context = stream_context_create($opts);
    
//     $wsdlUrl = 'https://s2s.oneecpay.com/wsbillpay/service1.asmx?op=Transact';
//     $soapClientOptions = array(
//         'stream_context' => $context,
//         'cache_wsdl' => WSDL_CACHE_NONE
//     );
    
//     $client = new SoapClient($wsdlUrl, $soapClientOptions);
    


    
    
    
  //  $client = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?wsdl");


//    $something = $client->ListOfContinentsByName();
   
 //encode to string
//    $jsonString = json_encode($something->ListOfContinentsByNameResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
//    var_dump($jsonString);
  
  //  $obj = json_decode($json);


} catch (Exception $e) {
    //handle error request
    echo $e->getMessage();
}

?>