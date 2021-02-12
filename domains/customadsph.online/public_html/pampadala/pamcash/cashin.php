<?php
//session_start();

// if ($_SESSION["session"] == NULL) {
//     header("Location: index.php");
//     exit();
// }

 $_SESSION['clientreference'] = "";
 $_SESSION['accounNo'] = "";
 $_SESSION['conveniencefee'] = 0.00;
 $_SESSION['amount'] = "";
 $_SESSION['service_code'] = "";

include '../samutsari/db.php';

date_default_timezone_set("Asia/Manila");
$date = date('m/d/Y h:i:s', time());

$accountId = ""; // $_POST['accountID'];
$branchId = ""; // $_POST['branchID'];
//$userName = ""; // $_POST['username']; username came from property
$password = ""; // $_POST['password'];

//get login cred
try {
    $sql = "SELECT a.`AccountID`, a.`BranchID`, a.`Username`,a.`Password`,b.`ClientReference`
            FROM `pampadala_users` a
            JOIN `pampadala_txn_history` b
            ON a.`username`= ?
            ORDER BY `ClientReference`
            DESC
            LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->execute([$username]);

    for ($i = 0; $row = $stmt->fetch(); $i ++) {
        $accountId = $row['AccountID'];
        $branchId = $row['BranchID'];
        $userName = $row['Username'];
        $password = $row['Password'];
        $clientReference = $row['ClientReference'] + 1;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// session for receipt
$_SESSION['clientreference'] = $clientReference;
$_SESSION['accountNo'] = $_POST['accountNo'];
$_SESSION['conveniencefee'] = 0.00;
$_SESSION['amount'] = $_POST['amount'];
$_SESSION['serviceType'] = $_POST['serviceType'];
$_SESSION['identifier'] = $_POST['identifier'];

//encrypting section
$date = date('Y/m/d', time());
$hash =  md5($date);
$secretkey = substr($hash, 0,12);
$signature = "tqmuMMyUhPF/tCYZ1/Z92VxIfEDpSYwGjhJogeP2KfGXQy8eNV6ZjErj8BT0RzZKp7khsWlTSx1tpkux2pDgHV1VFk42plX02WPU9qF5x7/Q/9pY0Yo+ZM5Ecao6zYJgwv3kaQHaE/qX/cBOzGx/YhWNDLBpFxDwUa33R2K";
//"RN520TWazaiD/XUzu1lmz80gZasfo/UfNqvRcqUXmHQASbDumZya15WbBl9fazK0GqzswWo2jwULHd6FwLBCwg=="; //7fbbd56fa7ebe0010ffb46534ab4f4a4;


//clear
$status = 0;
$message = "";
$servicecharge = 0;


try {

    $client = new SoapClient($cashin);

    $headerbody = array('AuthHeader'=>array(
        'Host'=>$Host,
        'Content-Type'=>$Content_Type,
        'signature' => $signature,
        'secretkey' => $secretkey ));

    $header = new SoapHeader('https://s2s.OneECPay.com/wsecash','AuthHeader', $headerbody);      
    $client->__setSoapHeaders($header);

    // Soap Call
    $transactresponse = $client->Transact(array(
        'AccntID' => $accountId,
        'BranchID' => $branchId,
        'Username' => $userName,
        'Password' => $password,
        'ServiceType' => $_SESSION['serviceType'],
        'AccountNO' => $_SESSION['accountNo'],
        'Identifier' => $_SESSION['identifier'],
        'Amount' => $_SESSION['amount'],
        'ClientReference' => "CASH".$clientReference
    ));
    
        $status = substr($transactresponse->TransactResult, 13,1);

    } catch (Exception $e) {
        echo $e->getMessage();
    }    


    if ($status == 0) {
        // success
        // get response message and service charge
        foreach ($array as $row) {            
            $message = str_replace("SUCCESS! REF #", "", $row->description);
            $servicecharge = $row->ServiceCharge;
            $_SESSION['conveniencefee'] = $servicecharge;
        }

        try {
            $sql = "INSERT INTO `pampadala_txn_history` (`AccountID`, `BranchID`, `Username`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            
            $stmt = $con->prepare($sql);
            $stmt->execute([$accountId, $branchId, $userName,  $_SESSION['accounNo'],$identifier,
                $serviceType, $amount, $clientReference,1,$message,$servicecharge]);
                        
          
            
            $date = date('m/d/Y h:i:s', time());

            error_log("$date ===> SUCCESS! REF# : $message, '$identifier','$serviceType', $amount,$clientReference \n", 3, "../logs/my-errors.log");
        
        } catch (PDOException $e) {
            error_log("Error: " . $sql . "<br>" . $e->getMessage() . "\n", 3, "../logs/my-errors.log");
        }

        $con = null;
        
        header("Location: successpayment.php");
        exit();
    } else {
        // ERROR
        $subDesc =  strstr($transactresponse->TransactResult, "description");
        $subDesc =  substr($subDesc, 13);
        $refnoPosition = strrpos($subDesc, "refno");
        echo $subDesc = substr($subDesc, 1,$refnoPosition -4);
           // $message = str_replace("'", "''", $row->Message);


        try {
            $sql = "INSERT INTO `pampadala_txn_history` ( `AccountID`, `BranchID`, `Username`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $con->prepare($sql);
            $stmt->execute([ $accountId, $branchId, $userName,  $_SESSION['accounNo'], $identifier,
                $serviceType, $amount, $clientReference,0,$message,0]);
           
            
            $date = date('m/d/Y h:i:s', time());
            // error response
            $_SESSION['errorresponse'] = $message;

            error_log("ERROR : $date ===> $message, '$serviceType', $accountNo, '$identifier', $amount, $clientReference  \n", 3, "../logs/my-errors.log");
        } catch (PDOException $e) {
            error_log("Error: " . $sql . "<br>" . $e->getMessage() . "\n", 3, "../logs/my-errors.log");
        }

        $con = null;
        
        header("Location: transaction.php");
        exit();
       
    }

?>





















