<?php
session_start();
if($_SESSION["session"] == NULL){
    
    // remove all session variables
    session_unset();
    
    // destroy the session
    session_destroy();
    header("Location: index.php");
    exit;
}


if (isset($_POST['billerTag'])) {
    $_SESSION['billerTag'] = trim($_POST['billerTag']);
}

?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
	integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
	crossorigin="anonymous">


<title>Biller</title>

</head>
<!--  <div name="yourDiv">
  <a href="choosebiller.php"><img src="img/back.png"></a>
</div> -->
<body class=" context-center">

    <?php
    if (isset($_SESSION['errorresponse'])) {
        echo $_SESSION['errorresponse'];
    }
    ?>
  <form class="" action="Txn.php" method="POST">

		<input type="text" required="" 	name="billerTag" class="form-control" placeholder="Biller Tag"
		value="<?php echo ltrim($_SESSION['billerTag']); ?>"  >
		<input type="text" required="" placeholder="Account Number" value="" name="accountNo" class="form-control"> 
		<input type="text" required="" placeholder="Account Name/Identifier" value="" name="identifier"	class="form-control"> 
		<input type="text" required="" placeholder="Amount" value="" name="amount" class="form-control">

		<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>


	</form>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!--     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
		  	<!-- Autologout user inactivity within 10 mins -->
    	<script type="text/javascript">
    		var t;
    		window.onload = resetTimer;
    		document.onkeypress = resetTimer;
    		window.onmousemove = resetTimer;
    
    		function logout() {
    			alert("Session Timeout!")
    			var url = 'logout.php';
    			location.href = url;
    		}
    
    		function resetTimer() {
    			clearTimeout(t);
    			t = setTimeout(logout, 600000)
    		}
    
    		function quit() {
    			event.returnValue = "Are you sure you have finished?"
    		}
    
    	</script>
	</body>
</html>
