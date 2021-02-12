<?php
echo 'test echo ';
echo '\n';
// Takes raw data from the request
 $json = file_get_contents('php://input');
 echo $json;
 echo '\n';
// // Converts it into a PHP object
 $data = json_decode($json);
echo "\n";
include('../db.php');

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$name = $data->name;
$productDesc = $data->productDesc;
$price = $data->price;
$imageUrl = $data->imageUrl;

$sql = "INSERT INTO `product` (name, productDesc, price, imageUrl)
VALUES ('$name','$productDesc', '$price', '$imageUrl')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
