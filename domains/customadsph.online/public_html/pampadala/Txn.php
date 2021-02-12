<?php
session_start();

if ($_SESSION["session"] == NULL) {
    header("Location: index.php");
    exit();
}

$_SESSION['clientreference'] = "";
$_SESSION['accounNo'] = "";
$_SESSION['conveniencefee'] = "";
$_SESSION['amount'] = "";
$_SESSION['billerTag'] = "";

include_once 'samutsari/db.php';

date_default_timezone_set("Asia/Manila");
$date = date('m/d/Y h:i:s', time());

$AccountID = ""; // $_POST['accountID'];
$BranchID = ""; // $_POST['branchID'];
$Username = ""; // $_POST['username'];
$Password = ""; // $_POST['password'];


$AccountNo = $_POST['accountNo'];
$Identifier = $_POST['identifier'];
$BillerTag = $_POST['billerTag'];
$Amount = $_POST['amount'];
$ClientReference = 0;

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
        $AccountID = $row['AccountID'];
        $BranchID = $row['BranchID'];
        $Username = $row['Username'];
        $Password = $row['Password'];
        $ClientReference = $row['ClientReference'] + 1;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// session for receipt
$_SESSION['clientreference'] = $ClientReference;
$_SESSION['accounNo'] = $AccountNo;
$_SESSION['conveniencefee'] = 0.00;
$_SESSION['amount'] = $Amount;
$_SESSION['billerTag'] = $BillerTag;
echo $_SESSION['billerTag'];
try {
    $client = new SoapClient($bills);

    // Soap call with Transact() method
    $transact_result = $client->Transact(array(
        'AccountID' => $AccountID,
        'BranchID' => $BranchID,
        'Username' => $Username,
        'Password' => $Password,
        'AccountNo' => $AccountNo,
        'Identifier' => $Identifier,
        'BillerTag' => $BillerTag,
        'Amount' => $Amount,
        'ClientReference' => $ClientReference
    ));
    // Convert object to array
    $array = (array) $transact_result;
    $status = 0;
    $message = "";
    $servicecharge = 0;

    // get response status code
    foreach ($array as $row) {
        $status = $row->Status;
    }

    if ($status == 0) {
        // success
        // get response message and service charge
        foreach ($array as $row) {            
            $message = str_replace("SUCCESS! REF #", "", $row->Message);
            $servicecharge = $row->ServiceCharge;
            $_SESSION['conveniencefee'] = $servicecharge;
        }

        try {
            $sql = "INSERT INTO `pampadala_txn_history` (`AccountID`, `BranchID`, `Username`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            
            $stmt = $con->prepare($sql);
            $stmt->execute([$AccountID, $BranchID, $Username, $AccountNo,$Identifier,
                $BillerTag, $Amount, $ClientReference,1,$message,$servicecharge]);
                        
          
            
            $date = date('m/d/Y h:i:s', time());

            error_log("$date ===> SUCCESS! REF# : $message, '$Identifier','$BillerTag', $Amount,$ClientReference \n", 3, "logs/my-errors.log");
        
        } catch (PDOException $e) {
            error_log("Error: " . $sqli . "<br>" . $e->getMessage() . "\n", 3, "logs/my-errors.log");
        }

        $con = null;
        
        header("Location: successpayment.php");
        exit();
    } else {
        // ERROR
        foreach ($array as $row) {
            // TransactResult.Status
            $status = $row->Status;
            $message = str_replace("'", "''", $row->Message);
        }

        try {
            $sql = "INSERT INTO `pampadala_txn_history` ( `AccountID`, `BranchID`, `Username`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`,`isSuccess`,`Message`,`ServiceCharge`
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $con->prepare($sql);
            $stmt->execute([ $AccountID, $BranchID, $Username, $AccountNo, $Identifier,
                $BillerTag, $Amount, $ClientReference,0,$message,0]);
           
            
            $date = date('m/d/Y h:i:s', time());
            // error response
            $_SESSION['errorresponse'] = $message;

            error_log("ERROR : $date ===> $message, '$BillerTag', $AccountNo, '$Identifier', $Amount, $ClientReference  \n", 3, "logs/my-errors.log");
        } catch (PDOException $e) {
            error_log("Error: " . $sql . "<br>" . $e->getMessage() . "\n", 3, "logs/my-errors.log");
        }

        $con = null;
        
        header("Location: transaction.php");
        exit();
       
    }
} catch (Exception $e) {
   echo $e->getMessage();
}

?>





















