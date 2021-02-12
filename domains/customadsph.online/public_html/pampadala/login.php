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



    try{
    
          $stmt = $con->prepare("SELECT * FROM `pampadala_users` WHERE `username` = ? and password = ? ");
          $stmt->execute([$username, $password]);
        
          //got data
          for ($i=0; $row = $stmt->fetch(); $i++) {            
                 $_SESSION["session"] = "session";
                  $con = null;
                 header("Location: dashboard.php"); 
                 exit;
          }   
          //no data
          echo "out";
          $con = null;
          header("Location: errorlogin.html");
          exit;
    
    }catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }


?>
































