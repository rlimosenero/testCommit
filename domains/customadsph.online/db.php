<?php
$server="localhost";
$userid ="root";
$db_password = "";
$myDB = "u914242254_iglobe";

 $test_bills = "https://myecpay.ph/WebService/wsbillpay/Service1.asmx?WSDL";
$username = "TEST_CUSTOMIZED";
$password = "godfirst";


 $prod_bills = "https://s2s.OneECPay.com/wsbillpay/Service1.asmx?wsdl";
 $prod_username = "causer1";
 $prod_password = "CustomAd$2014";
try{
	$con = new PDO("mysql:host=$server;dbname=$myDB", $userid, $db_password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// $stmt = $con->prepare("SELECT a.`AccountID`, a.`BranchID`, a.`Username`,a.`Password`,b.`ClientReference` FROM `pampadala_users` a  JOIN `pampadala_txn_history` b ON a.`username`= 'TEST_CUSTOMIZED' ORDER BY `ClientReference` DESC LIMIT 1");
	// $stmt->execute();

 //  // set the resulting array to associative
 //  // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	// for ($i=0; $row = $stmt->fetch(); $i++) { 
	// 	echo "counter " .$i. "<br>";
	// 			echo "counter " .$i;
	// 	echo  $row['AccountID'];
	// 	echo  $row['BranchID'];
	// 	echo  $row['Username'];
	// 	echo $row['Password'];
 //  		$AccountID =  $row['AccountID'];
	// 	$BranchID =  $row['BranchID'];
	// 	$Username =  $row['Username'];
	// 	$Password =  $row['Password'];
	// 	$ClientReference =  $row['ClientReference'] + 1;
	// }
} catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
 // $con = null;

// echo $AccountID ;
// echo $BranchID ;
// echo $Username;
// echo $Password;
// echo $ClientReference;
  
//   $stmt = $con->prepare("SELECT * FROM `pampadala_users` ");
//   $stmt->execute();
 
//  	//if ($stmt->fetch() > 0) {
//  		for ($i=0; $row = $stmt->fetch(); $i++) { 

//  		        if ($row['username'] == $username && $row['password'] == $password) {
//            //$username = $row['username'];
//            //$password = $row['password'];
//            $_SESSION["session"] = "session";
//            //response($username,$password,200,"Success");
           

//            // header("Location: dashboard.php"); 
//            // exit;
//        }
//  	}
//   // set the resulting array to associative
//   // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
// } catch(PDOException $e) {
//   echo "Error: " . $e->getMessage();
// }
// $con = null;


//mysqli example
// $con = mysqli_connect($server,$userid,$password,$myDB);

// if (mysqli_connect_errno()){

// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();

// 	die();
// }
?>

