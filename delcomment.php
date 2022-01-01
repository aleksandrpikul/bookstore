<?php
require('connect.php');
 
if(isset($_GET['email']) & !empty($_GET['email'])){
	$name = $_GET['email'];
 
	$delsql="DELETE FROM `comments` WHERE email=$email";
	if(mysqli_query($connection, $delsql)){
		header("Location: viewcomments.php");
	}
}else{
	header('location: viewcomments.php');
}
 
?>
