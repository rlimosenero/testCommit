<?php
session_start();

include 'samutsari/db.php'; 

$username = "";
$password = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

}else{
  echo "false";
  header("Location: errorlogin.html");
  exit;
}

$username = stripcslashes($username);
$password = stripcslashes($password);


try{

      $stmt = $con->prepare("SELECT * FROM `pampadala_users` ");
      $stmt->execute();
    
      //got data
      for ($i=0; $row = $stmt->fetch(); $i++) { 
    
            if ($row['username'] == $username && $row['password'] == $password) {
        
             $_SESSION["session"] = "session";
        
              $con = null;
             header("Location: dashboard.php"); 
             exit;
           }else{
            $con = null;
             header("Location: errorlogin.html");
             exit;
        
           }
      }   

}catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}




function response($username,$password,$response_code,$response_desc){
  $response['username'] = $username;
  $response['password'] = $password;
  $response['response_code'] = $response_code;
  $response['response_desc'] = $response_desc;

  $json_response = json_encode($response);
  echo $json_response;
}


?>