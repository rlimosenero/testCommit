<?php
 session_start();
 $_SESSION['clientreference'] = "" ;
 $_SESSION['accounNo'] = "";
 $_SESSION['conveniencefee'] = "";
 $_SESSION['amount'] = "";
 $_SESSION['billerTag'] = "";
// if($_SESSION["session"] == NULL){
//   header("Location: index.php"); 
//            exit;
//}

include_once '../db.php';
$date = date('m/d/Y h:i:s', time());
error_log("$date ===> testing123 \n", 3, "logs/my-errors.log");
$AccountID= "";//$_POST['accountID'];
$BranchID= "";//$_POST['branchID'];
$Username= "";//$_POST['username'];
$Password= "";//$_POST['password'];
$Host='myecpay.ph';
$Content_Type='text/xml; utf-8';

$AccountNo= $_POST['accountNo'];
$Identifier= $_POST['identifier'];
$BillerTag= $_POST['billerTag'];
$Amount= $_POST['amount'];
$ClientReference= 0;





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
//session for receipt
		$_SESSION['clientreference'] = $ClientReference;
		 $_SESSION['accounNo'] = $AccountNo;
		 $_SESSION['conveniencefee'] = 0.00;
		 $_SESSION['amount'] = $Amount;
		 $_SESSION['billerTag'] = $BillerTag;

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


		$sqli = "INSERT INTO `pampadala_txn_history` (`txnID`, `AccountID`, `BranchID`, `Username`, `Password`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`) VALUES (NULL, $AccountID, $BranchID, '$Username', '$Password', $AccountNo, '$Identifier', '$BillerTag', $Amount, $ClientReference,1,'$message',$servicecharge)";
		if ($con->query($sqli) === TRUE) {
			$date = date('m/d/Y h:i:s', time());

  			error_log("$date ===> SUCCESS! REF# : $message, '$Identifier','$BillerTag', $Amount, $ClientReference \n", 3, "logs/my-errors.log");
		} else {
			error_log("Error: " . $sqli . "<br>" . $con->error . "\n", 3, "logs/my-errors.log");
		}

		$con->close();
		//mysqli_query($con, $sqli);

		//echo json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		
		   header("Location: successpayment.php"); 
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

  			error_log("ERROR : $date ===> $message, '$Identifier','$BillerTag', $Amount, $ClientReference  \n", 3, "logs/my-errors.log");
		} else {
			  error_log("Error: " . $sqli . "<br>" . $con->error . "\n", 3, "logs/my-errors.log");
			//echo "Error: " . $sqli . "<br>" . $con->error;
		}

		$con->close();
		// header("Location: v2/transaction.php"); 
  //          exit;
        //TODO: create session and upon submit verify if already used client reference
		//echo json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

	}


}catch(Exception $e){
	echo $e->getMessage();
}


?>
