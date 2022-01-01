<?php
	session_start();

	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase Process";
	require "./template/header.php";
	// connect database
	$conn = db_connect();

		$firstname = trim($_POST['firstname']);
		$firstname = mysqli_real_escape_string($conn, $firstname);
		
		$lastname = trim($_POST['lastname']);
		$lastname = mysqli_real_escape_string($conn, $lastname);
	
		
		$address = trim(trim($_POST['address']));
		$address = mysqli_real_escape_string($conn, $address);
		
		$city = trim($_POST['city']);
        $city = mysqli_real_escape_string($conn, $city);
        
		$zipcode = trim($_POST['zipcode']);
		$zipcode = mysqli_real_escape_string($conn, $zipcode);

	// find customer
	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id=$customer['id'];
	$query="UPDATE customers set 
	firstname='$firstname', lastname='$lastname' , address='$address', city='$city', zipcode='$zipcode'  where id='$id'
	";
	mysqli_query($conn, $query);
	$date = date("Y-m-d H:i:s");
	// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
	insertIntoCart($conn, $customer['id'],$date);

	// take orderid from order to insert order items
	// $orderid = getOrderId($conn, $customer['id']);
	$Cartid = getCartId($conn, $customer['id']);

	

	unset($_SESSION['total_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);

?>











<h1 class="display-1 text-center">ПОКУПКА ПРОШЛА УСПЕШНО =)</h1>
   <script>
   	
		window.setTimeout(function(){

		//window.location.href = "http://localhost/onlineBookStore/index.php";

		}, 3000);
	
   </script>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
