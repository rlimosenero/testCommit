<?php
// session_start();
// if($_SESSION["session"] == NULL){
//   header("Location: index.php"); 
//            exit;
// }
include '../../db.php';
$output ='';

if(isset($_POST['query'])){
	$search = $_POST['query'];
	try{
		$stmt = $con->prepare(
					"SELECT BillerName FROM pampadala_ecpay_biller WHERE BillerName LIKE CONCAT('%',?,'%') "
						);
          $stmt->bind_param("s",$search);
          $stmt->execute();  
          $result=$stmt->get_result();	

          if($result->num_rows>0){
          	 while ($row=$result->fetch_assoc()) {
 

                    echo "<tr><td>" . $row['BillerName'] . "</td></tr>" ;
          	
          }
      }
	}catch (Exception $ex){
		echo $ex;
	}

}


 ?>
