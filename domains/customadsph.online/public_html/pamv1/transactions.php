<!DOCTYPE html>
<html>
<head>
  <title>Transaction Type</title>
  <?php 
include '../db.php'; 
    // $server="localhost";
    // $userid ="root";
    // $Password = "";
    // $myDB = "booksdb";

 //   $con = mysqli_connect($server,$userid,$Password,$myDB);

    // if (mysqli_connect_errno()) {
    //  # code...
    //   echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // }
 

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="custom.css">

</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-md-4">
        <div class="form_main">
                <h4 class="heading"><strong>Transaction </strong> Info <span></span></h4>
                <div class="form">
                <form action="Txn.php" method="post" id="contactFrm" name="contactFrm">
                    <input type="password" required="" placeholder="Please input your AccountID" value="330" name="accountID" class="txt">
                    <input type="password" required="" placeholder="Please input your username" value="TEST_CUSTOMIZED" name="username" class="txt">
                    <input type="password" required="" placeholder="Please input your password" value="w0rdPas$" name="password" class="txt">
 <input type="text" required="" placeholder="Branch ID" value="41254" name="branchID" class="txt">
 <input type="text" required="" placeholder="Account Number" value="" name="accountNo" class="txt">
 <input type="text" required="" placeholder="Identifier" value="" name="identifier" class="txt">
 <select name="billerTag" class="txt">
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
 <!-- <input type="text" required="" placeholder="Biller Tag" value="" name="billerTag" class="txt"> -->
 <input type="text" required="" placeholder="Amount" value="" name="amount" class="txt">
 <input type="text" required="" placeholder="Client Reference" value="" name="clientreference" class="txt">

                    
                     <textarea placeholder="Your Message" name="mess" type="text" class="txt_3"></textarea>
                     <input type="submit" value="submit" name="submit" class="txt2">
                </form>
            </div>
            </div>
            </div
    </div>
</div>
</body>
</html>
<?php mysqli_close($con); ?>
