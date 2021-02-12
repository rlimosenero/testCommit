<html>
<title>Populate Drop Down List From Database Using MySQLi</title>
<?php 
include '../db.php'; 
	// $server="localhost";
	// $userid ="root";
	// $Password = "";
	// $myDB = "booksdb";

 //   $con = mysqli_connect($server,$userid,$Password,$myDB);

	// if (mysqli_connect_errno()) {
	// 	# code...
	// 	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	// }
 

?>
<header> 
	<h1 align="center">Fill Data in a Select Box using MySQLi</h1>
</header>
<style type="text/css">
#box{
	width: 100%;
}
.column {
	width: 33.33%;
	display: inline-block; 
} 
.form{  
	padding: 2px;
	width: 100%;
	display: inline-block;
}

.first-column {
    display: inline-block;
    width: 100px;
    height: 2px;
    margin: 2px;
    position: inherit;
}
.second-column{
	display: inline-block;
    width: 150px;
    height: 2px;
    margin: 2px;
    position: inherit;
}
select {  
    width: 150px;  
    font-size: 12px;
    height: 25px;
    padding: 4px
}
.clear{
	  clear: left;
	  height: 15px;
}
 
 
</style>
<body>
	<div id="box">
	<div class="column"></div>
	<div class="column"> 
			<div class="clear"></div> 
			<label class="first-column ">Select a Book:</label><div class="second-column">
				<select>
					<option>Select</option>
					<option>Select</option>
					<option>Select</option>
					<option>Select</option>
					<option>Select</option>
				<?php 

					$sqli = "SELECT `BillerName` FROM `pampadala_ecpay_biller`";
					$result = mysqli_query($con, $sqli);
					 while ($row = mysqli_fetch_array($result)) {
					 		# code...
					 	echo '<option>'.$row['BillerName'].'</option>';
					 }	
 

					?>
				</select>

			</div>
			<div class="clear"></div>  
			<div class="clear"></div>   
		 
	</div>
	<div class="column"></div> 
	</div>
</body>
</html>

<?php mysqli_close($con); ?>
