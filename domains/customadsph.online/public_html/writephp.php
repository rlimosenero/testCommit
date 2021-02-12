<?php
//$servername = "localhost";
//$username = "u914242254_api_user";
//$password = "godfirst";
//$dbname = "u914242254_iglobe";
    include('db.php');

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$amount = 500;
$sql = "INSERT INTO transactions (order_id, amount, response_code, response_desc)
VALUES (5,$amount, 1, 'john@example.com')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
