<?php
	session_start();
	$title = "User Signup";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

		$firstname = trim($_POST['firstname']);
		if ($firstname != '' && strlen($firstname) < 5) {
		    echo "Слишком короткий псевдоним =(" . mysqli_error($conn);
	            	exit; } 
		$firstname = mysqli_real_escape_string($conn, $firstname);
		
		$lastname = trim($_POST['lastname']);
		if ($lastname != '' && strlen($lastname) < 5) {
		    echo "Слишком короткий псевдоним =(" . mysqli_error($conn);
	            	exit; } 
		$lastname = mysqli_real_escape_string($conn, $lastname);

		$email = trim($_POST['email']);
		if(!(preg_match("/@/", $email))){
		    echo "Неверный email =(" . mysqli_error($conn);
			exit;}
		$email = mysqli_real_escape_string($conn, $email);
		
		$password = trim($_POST['password']);  
		$password2 = trim($_POST['password2']); 
		if ($_POST['password'] != $_POST['password2']) {
		    echo "Пароли не совпадают =(" . mysqli_error($conn);
	            	exit; }  
		if ($password != '' && strlen($password) < 8) {
		    echo "Пароль должен быть больше 8 символов. Слабый пароль =(" . mysqli_error($conn);
	            	exit; }   
		if(!(preg_match("/([0-9]+)/", $password))){
		    echo "Не хватает цифр. Слабый пароль =(" . mysqli_error($conn);
			exit;}
		if(!(preg_match("/([a-z]+)/", $password))){
		    echo "Не хватает маленьких букв. Слабый пароль =(" . mysqli_error($conn);
			exit;}
		if(!(preg_match("/([A-Z]+)/", $password))){
		    echo "Не хватает больших букв. Слабый пароль =(" . mysqli_error($conn);
			exit;}
		$password = md5(mysqli_real_escape_string($conn, $password));
		
		$address = trim(trim($_POST['address']));
		$address = mysqli_real_escape_string($conn, $address);
		
		$city = trim($_POST['city']);
       		$city = mysqli_real_escape_string($conn, $city);
        
		$zipcode = trim($_POST['zipcode']);
		if ($zipcode != '' && strlen($zipcode) < 11) {
		    echo "Номер должен содержать 11 цифр =(" . mysqli_error($conn);
	            	exit; } 
		$zipcode = mysqli_real_escape_string($conn, $zipcode);


		if ($_POST['captcha'] != $_SESSION['captcha']){
		    echo "Проверка не пройдена =(" . mysqli_error($conn);
	            	exit;
		}

          
		if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($address)||empty($city)||empty($zipcode)){
				header("Location:../onlinebookstore/signup.php?signup=empty");
		}else{
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				header("Location:../onlinebookstore/signup.php?signup=invalidemail");
			}else{
				$findUser = "SELECT * FROM customers WHERE email = '$email'";
				$findResult = mysqli_query($conn, $findUser);
				if(mysqli_num_rows($findResult)==0){
					$insertUser = "INSERT INTO customers(firstname,lastname,email,address,password,city,zipcode) VALUES 
					('$firstname','$lastname','$email','$address','$password','$city','$zipcode')";
					$insertResult = mysqli_query($conn, $insertUser);
					if(!$insertResult){
						echo "Can't add new user " . mysqli_error($conn);
						exit;
				}
				$userid = mysqli_insert_id($conn);
				header("Location: signin.php");
				} else {
					$row = mysqli_fetch_assoc($findResult);
					$userid = $row['id'];
					header("Location: signin.php");
				}
			}
		}	
?>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>











