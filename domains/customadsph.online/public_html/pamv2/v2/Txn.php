<?php
// session_start();
// if($_SESSION["session"] == NULL){
//   header("Location: index.php"); 
//            exit;
//}

include_once '../db.php';
$AccountID= "";//$_POST['accountID'];
$BranchID= "";//$_POST['branchID'];
$Username= "";//$_POST['username'];
$Password= "";//$_POST['password'];
$Host='myecpay.ph';
$Content_Type='text/xml; utf-8';

$AccountNo= $_POST['accountNo'];//'Hde1234567890';
$Identifier= $_POST['identifier'];//'Karla Lapurga';
$BillerTag= $_POST['billerTag'];//'HOME_OUTLET';
$Amount= $_POST['amount'];//'5000';
$ClientReference= 0;//$_POST['clientreference'];

$sqli = "SELECT  `AccountID`,`BranchID`,`Username`,`Password`,`ClientReference` FROM `pampadala_txn_history` ORDER BY `ClientReference` DESC limit 1";
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
                            # code...
	$AccountID = $row['AccountID'];
	$BranchID = $row['BranchID'];
	$Username = $row['Username'];
	$Password = "godfirst";
	$ClientReference = $row['ClientReference'] + 1;
}  


try{
	$client = new SoapClient("https://myecpay.ph/WebService/wsbillpay/Service1.asmx?WSDL");



	$headerbody = array('GetBillerList'=>array('Host'=>$Host,'Content-Type'=>$Content_Type)); 
	$header = new SoapHeader('http://tempuri.org/ECPNBillsPayment/Service1','GetBillerList', $headerbody);       

//set the Headers of Soap Client.
	$client->__setSoapHeaders($header); 

// Soap call with HelloWorld() method
	$something =  $client->Transact(
		array('AccountID' => $AccountID,'BranchID'=>$BranchID,'Username' => $Username,'Password'=>$Password,'AccountNo'=>$AccountNo,'Identifier'=>$Identifier,'BillerTag'=>$BillerTag,'Amount'=>$Amount,'ClientReference'=>$ClientReference)
	);
		// Convert object to array
	$array = (array)$something;
	$status = 0;
	$message = "";
	$servicecharge = 0;
	foreach ($array as $row) {	$status = $row->Status ; } 

	if($status == 0){
		//success

 	foreach ($array as $row) {		  	
			
			//$status = $row->Status ;
			$message = str_replace("SUCCESS! REF #", "", $row->Message);
         	$servicecharge = $row->ServiceCharge;
		} 

		//todo { "Status": "0", "Message": "SUCCESS! REF #C505D15F0A85", "ServiceCharge": "0.00" } 
		$sqli = "INSERT INTO `pampadala_txn_history` (`txnID`, `AccountID`, `BranchID`, `Username`, `Password`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`) VALUES (NULL, $AccountID, $BranchID, '$Username', '$Password', $AccountNo, '$Identifier', '$BillerTag', $Amount, $ClientReference,1,'$message',$servicecharge)";
		if ($con->query($sqli) === TRUE) {
			$date = date('m/d/Y h:i:s', time());

  			error_log("$date ===> SUCCESS! REF# : $message, '$Identifier','$BillerTag', $Amount, $ClientReference \n", 3, "../logs/my-errors.log");
		} else {
			error_log("Error: " . $sqli . "<br>" . $con->error . "\n", 3, "logs/my-errors.log");
		}

		$con->close();
		//mysqli_query($con, $sqli);

		//echo json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		
		   header("Location: v2/successpayment.php"); 
           exit;
	}else{
		//ERROR
;
		foreach ($array as $row) {		  	
                         //TransactResult.Status
			$status = $row->Status ;
			$message =  str_replace("'", "''", $row->Message);

		}  
		$sqli = "INSERT INTO `pampadala_txn_history` (`txnID`, `AccountID`, `BranchID`, `Username`, `Password`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`) VALUES (NULL, $AccountID, $BranchID, '$Username', '$Password', $AccountNo, '$Identifier', '$BillerTag', $Amount, $ClientReference,0,'$message',0)";
			//mysqli_query($con, $sqli);
		if ($con->query($sqli) === TRUE) {
			$date = date('m/d/Y h:i:s', time());

  			error_log("ERROR : $date ===> $message, '$Identifier','$BillerTag', $Amount, $ClientReference  \n", 3, "../logs/my-errors.log");
		} else {
			  error_log("Error: " . $sqli . "<br>" . $con->error . "\n", 3, "logs/my-errors.log");
			//echo "Error: " . $sqli . "<br>" . $con->error;
		}

		$con->close();
		header("Location: v2/transaction.php"); 
           exit;
        //TODO: create session and upon submit verify if already used client reference
		//echo json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

	}


}catch(Exception $e){
	echo $e->getMessage();
}


?>

<!--
	27255971.10
	27250464.47
	5506.63
	27245449.47
"BillerTag": "MANILAWATER",
"Description": "MANILA WATER COMPANY",
"FirstField": "8 Digit Contract Account Number",
"FirstFieldFormat": "Numeric",
"FirstFieldWidth": "8",
"SecondField": "Account Name",
"SecondFieldFormat": "Alphanumeric",
"SecondFieldWidth": "30",
"ServiceCharge": "0.00"
GetBillerListResult.BStruct[0].BillerTag
GetBillerListResult.BStruct[1].BillerTag
-->
