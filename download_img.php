<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);
error_reporting(E_ALL);
if(isset($_POST['save'])){
    require_once "./functions/database_functions.php";
    require "./template/header.php";
    $conn = db_connect();

    $path="/var/www/myshop33.ru/bootstrap/users_images/";
    $userfile = $_FILES['imageupload']['name'];//Name of the File
    $temp = $_FILES['imageupload']['tmp_name'];
    if(move_uploaded_file($temp, $path . $userfile)){
 	header("Location: profile.php");

    require_once("./functions/database_functions.php");

    $customer = getCustomerIdbyEmail($_SESSION['email']);
        $id=$customer['id'];
    $query="UPDATE customers set 
    userfile='$userfile' where id='$id'";
        mysqli_query($conn, $query);
    }
}
?>
