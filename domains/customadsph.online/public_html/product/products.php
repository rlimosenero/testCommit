<?php
header("Content-Type: application/json; charset=UTF-8");
include('../db.php');
//$obj = json_decode($_GET["x"], false);

//$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$stmt = $con->prepare("SELECT id,name,productDesc,price,imageUrl FROM product LIMIT 10");
//$stmt->bind_param("s", $obj->limit);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

$json_response = json_encode($outp);
echo $json_response
?>