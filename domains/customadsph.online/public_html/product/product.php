<?php
header("Content-Type:application/json");
//check if not null
if (isset($_GET['id']) && $_GET['id']!="") {
    include('../db.php');
    $id = $_GET['id'];
    $result = mysqli_query(
                           $con,
                           "SELECT * FROM `product` WHERE id=$id");
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $name = $row['name'];
        $productDesc = $row['productDesc'];
        $price = $row['price'];
        $imageUrl = $row['imageUrl'];
        //call
        response($id, $name, $productDesc, $price,$imageUrl);
        mysqli_close($con);
    }else{
        response(NULL, NULL, 200,"No Record Found");
    }
}else{
    response(NULL, NULL, 400,"Invalid Request");
}

function response($id, $name, $productDesc, $price,$imageUrl){
    $response['id'] = $id;
    $response['name'] = $name;
    $response['productDesc'] = $productDesc;
    $response['price'] = $price;
    $response['imageUrl'] = $imageUrl;
    
    $json_response = json_encode($response);
    echo $json_response;
}
?>

