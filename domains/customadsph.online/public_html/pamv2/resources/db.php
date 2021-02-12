<?php
$server="localhost";
$userid ="root";
$Password = "";
$myDB = "u914242254_iglobe";
$con = mysqli_connect($server,$userid,$Password,$myDB);

if (mysqli_connect_errno()){

	echo "Failed to connect to MySQL: " . mysqli_connect_error();

	die();
}
?>

