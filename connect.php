<?php
	$connection = mysqli_connect('localhost', 'root', '5199036', 'my-db2');
 mysqli_query($connection, "SET NAMES 'utf8'");
	if(!$connection){
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    	exit;
	}
?>
