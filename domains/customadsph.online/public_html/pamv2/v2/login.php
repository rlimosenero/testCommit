<?php
session_start();

include '../../db.php'; 

$username = "customads";//$_POST['username'];
$password = "CustomAds2014";//$_POST['password'];

$username = stripcslashes($username);
$password = stripcslashes($password);

//$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);
try{
    $result = mysqli_query($con,"SELECT * FROM `pampadala_users` WHERE username ='$username' AND password ='$password'") or die("Query Failed!!! " .mysql_error());

//$row = mysql_fetch_array('$result');
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        if ($row['username'] == $username && $row['password'] == $password) {
           $username = $row['username'];
           $password = $row['password'];
           $_SESSION["session"] = "session";
           //response($username,$password,200,"Success");
           

           header("Location: dashboard.php"); 
           exit;
       } else {
        echo "Failed :(";
    }
    mysqli_close($con);
}else{
    header("Location: errorlogin.html");
    //response(NULL, NULL, 400,"Invalid Request");
}


}catch(Exception $e){
	echo $e;
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