<?php

// if($_SESSION["session"] == NULL){
    
//     // remove all session variables
//     session_unset();
    
//     // destroy the session
//     session_destroy();
    
//     header("Location: index.php");
//     exit;
// }

include 'samutsari/db.php';

try{    
    $stmt = $con->prepare("SELECT `AccountID`,  `Username`,`Password` FROM `pampadala_users` where `username`= ? ");
    $stmt->execute([$username]);
    //get data
    for ($i=0; $row = $stmt->fetch(); $i++) {
         $AccountID =  $row['AccountID'];       
         $Username =  $row['Username'];
         $Password =  $row['Password'];       
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$con = null;

try {
    $client = new SoapClient($bills);


    $something = $client->CheckBalance(array(
        'AccountID' => $AccountID,
        'Username' => $Username,
        'Password' => $Password
    ));
    $json = json_encode($something, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $obj = json_decode($json);

} catch (Exception $e) {
    //handle error request
    echo $e->getMessage();
}

?>