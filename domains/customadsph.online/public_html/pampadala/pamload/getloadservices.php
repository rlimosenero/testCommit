<?php

// if($_SESSION["session"] == NULL){
    
//     // remove all session variables
//     session_unset();
    
//     // destroy the session
//     session_destroy();
    
//     header("Location: index.php");
//     exit;
//}

include '../samutsari/db.php';

try{    
    $stmt = $con->prepare("SELECT `AccountID`,  `Username`,`Password`,`BranchID` FROM `pampadala_users` where `username`= ? ");
    $stmt->execute([$username]);
    //get data
    for ($i=0; $row = $stmt->fetch(); $i++) {
         $AccountID =  $row['AccountID'];       
         $Username =  $row['Username'];
         $Password =  $row['Password'];
         $BranchID = $row['BranchID'];
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$con = null;

try {
    $client = new SoapClient($eload);
    

    $something = $client->GetTelcoList(array(
        'LoginInfo' => array (
            'AccountID' => $AccountID,
            'Username' => $Username,
            'Password' => $Password,
            'BranchID' => $BranchID
        )
        
    ));

    //display the object in a json format
    //$json = json_encode($something, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
   // var_dump($something->GetTelcoListResult->TStruct[0]);//this is an object

    //this is the json object
     $obj = $something->GetTelcoListResult->TStruct;


    //var_dump($obj);//array of json object
//echo $obj[2]->Services;
    foreach($obj as $value){        
      echo '<tr><td>' . $value->TelcoTag . '<td>'; 
      echo '<td>' . '               ' . $value->TelcoName . '<td>' ;
      echo '<td>' . '               ' . $value->Denomination . '<td>' ;
      echo '<td>' . '               ' . $value->ExtTag . '<td>' ;
      echo '<tr>';
 echo "<hr>";
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

?>
















