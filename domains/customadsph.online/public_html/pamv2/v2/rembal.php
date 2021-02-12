<?php 
// session_start();
// if($_SESSION["session"] == NULL){
//   header("Location: index.php"); 
//            exit;
// }
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->

  <?php   
  //include '../db.php';
  include 'CheckBalance.php'; 
    //$remBal = stripcslashes($remBal);

  ?>

  <style type="text/css">

   .number {
    padding-top: 0px;
    padding-bottom: 30px;
  }
  .tablegrid{
    padding-top: 30px;
  }

  hr {
    display: block;
    unicode-bidi: isolate;
    margin-block-start: 0.5em;
    margin-block-end: 0.5em;
    margin-inline-start: auto;
    margin-inline-end: auto;
    margin-top: 0px;
    margin-bottom: 0px;
    overflow: hidden;
    border-style: inset;
    border-width: 1px;
  }

  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  .mobile-container {
    max-width: 480px;
    margin: auto;
    background-color: #ddd;
    height: 667px;
    color: white;
    border-radius: 10px;
  }

  .topnav {
    overflow: hidden;
    background-color: blue;
    position: relative;
  }

  .topnav #myLinks {
    display: none;
    background: grey;
  }

  .topnav a {
    color: white;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    display: block;
  }

  .topnav a.icon {
    background: blue;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
  }

  .topnav a:hover {
    background-color: blue;
    color: black;
  }

  .active {
    background-color: blue;
    color: white;
  }
</style>
</style>
</head>
<body>
  <!-- Simulate a smartphone / tablet -->
  <div class="mobile-container">

    <!-- Top Navigation Menu -->
    <div class="topnav">
      <a href="#home" class="active">PamPadala</a>
      <div id="myLinks">
        <a href="choosebiller.php">Bills</a>
        <a href="choosebiller.php">Load</a>
        <a href="#">eCash</a>
        <a href="signout.php">Signout</a>
      </div>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a><hr>
    </div>

    <div  class="container"  style="background-color:blue;">
      <!-- <div><img src="img/pampadala-no-white.png"></div> -->
      <div class="number" align="center">
        <h3 style="color:white">
          PHP <?php echo number_format($obj->CheckBalanceResult->RemBal / 100, 2, ".", ",") ; ?>    
        </h3>
        <h5 style="color:white">Available Balance</h5>
      </div>

    </div>
    <div class="container">
      <div class="tablegrid">
        <div class="col-4">
          <table class="table table-image">

            <tbody >
              <tr>
                <td class="w-50"><a href="landing.php"><img  class="img-fluid img-thumbnail" src="img/wallet.jpg"></a></td>
                <td class="w-50"><a href="choosebiller.php"><img  class="img-fluid img-thumbnail" src="img/eload.png"></a></td>
                <td class="w-50"><a href=""><img class="img-fluid img-thumbnail" src="img/bank-transfer.png"></a></td>
                <td class="w-50"><a href=""><img class="img-fluid img-thumbnail" src="img/smart-money-padala.png"></a></td>

              </tr>
              <tr>
                <td class="w-50"><a href=""><img class="img-fluid img-thumbnail" src="img/eload.png"></a></td>
                <td class="w-50"><a href=""><img class="img-fluid img-thumbnail" src="img/eload.png"></a></td>
                <td class="w-50">
                  <a href="choosebiller.php">
                    <img class="img-fluid img-thumbnail" src="img/water.png">
                  </a>
                </td>
                <td class="w-50">
                  <a href="">
                    <img class="img-fluid img-thumbnail" src="img/palawan-logo.png">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>   
        </div>
      </div><!-- tablegrid -->
    </div><!-- container -->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }
    </script>
  </body>
  </html>
  <?php mysqli_close($con); ?>