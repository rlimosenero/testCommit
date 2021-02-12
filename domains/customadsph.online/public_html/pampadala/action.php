<?php
session_start();
if ($_SESSION["session"] == NULL) {

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    header("Location: index.php");
    exit();
}

include 'samutsari/db.php';
$output = '';

if (isset($_POST['query'])) {
    $search = $_POST['query'];
    try {
        $stmt = $con->prepare("SELECT  BillerName FROM pampadala_ecpay_biller WHERE BillerName LIKE CONCAT('%',?,'%') ");
        $stmt->bindParam(1, $search);
        $stmt->execute();

        for ($i = 0; $row = $stmt->fetch(); $i ++) {
            echo "<tr><td>";
echo trim($row['BillerName']);
echo "</td></tr>";
            $con = null;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

?>
