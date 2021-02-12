<?php 
// session_start();
// if($_SESSION["session"] == NULL){

// // remove all session variables
// session_unset();

// // destroy the session
// session_destroy();
//   header("Location: index.php"); 
//            exit;
// }
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style type="text/css">
        body{
            font-size: 3.5rem;
        }
        #submit_search{
          visibility: hidden;
        }
        hr{
          margin-top: 0px;
          margin-bottom: 0px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar  ">
      <!-- Brand -->
      <a class="navbar-brand navbar-dark" href="#">PamPadala</a>

      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
</div>
</nav>


<div class="container-fluid">
    <div class="row">
        <div >

            <div class="input-group">
              <form action="transaction.php" method="POST" id="myForm">
                  <input type="text" id="search_text" name="billerTag" class="input-control input-control-lg">
                  <input type="submit" id="submit_search">
              </form>

          </div>
          <hr>
          <?php 
          include '../db.php';
          $stmt = $con->prepare("SELECT `BillerName` FROM `pampadala_ecpay_biller`");
          $stmt->execute();
          $result = $stmt->get_result();  
          ?>



          <table class="table table-hover" id="table-data" cellspacing="1">             

            <tbody> 
                <?php  
                while ($row=$result->fetch_assoc()) {?>
                    <tr>
                        <td><?= $row['BillerName']; ?></td>
                    </tr>    
                <?php }?>             

            </tbody> 
        </table>
    </div>

</div>

</div>

<script type="text/javascript">
        //autofilter searchbox
      $(document).ready(function(){
        $("#search_text").keyup(function(){          
          var search = $(this).val();
          
          $.ajax({
            url:'action.php',
            method:'POST',
            data:{query:search},
            success:function (response) {
              $("#table-data").html(response);
            }
          });
        });
      });
</script>





    <script type="text/javascript">
          var table = document.getElementById( 'table-data' ),
          inputHash = {
              '0': 'search_text'
          };

          for ( var i in inputHash )
              inputHash[ i ] = document.getElementById( inputHash[ i ] );
          //select and put current value to form
          table.addEventListener( 'mousedown', function( evt ) {
                                                var target = evt.target;

                                                if ( target.nodeName != 'TD' )
                                                    return;

                                                var columns = target.parentNode.getElementsByTagName( 'td' );

                                                for ( var i = columns.length; i-- ; )
                                                    inputHash[ i ].value = columns[ i ].innerHTML;
                                              }
                                );

          // post billerTag
          table.addEventListener( 'mouseup', function( evt ) {
                                            formSubmit();
                                    }
                                 );


      function formSubmit() {

        document.getElementById("myForm").submit();
      }

    </script>
  </body>
</html>






