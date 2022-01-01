<?php
	session_start();
	require_once "./functions/database_functions.php";
	require "./template/header.php";
	$conn = db_connect();

	$name = trim($_POST['username']);
	$pass = trim($_POST['password']);
        $pass2 = trim($_POST['password2']); 

	if(empty($name) || empty($pass)){
		header("Location:../signin.php?signin=empty");
	}else{ 

				$name = mysqli_real_escape_string($conn, $name);
				$pass = md5(mysqli_real_escape_string($conn, $pass));

				if ($_POST['password'] != $_POST['password2']) {
				        echo "Пароли не совпадают =(" . mysqli_error($conn);
				    	    exit;
				}  

				if ($_SESSION['email'] != $name || $pass != $row['password']) {
					echo "Данные введены неверно =(";
		                } 
				$name = mysqli_real_escape_string($conn, $name);


				$query = "SELECT name,pass from manager";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				 if($name == $row['name'] && $pass == $row['pass'] ){
					$_SESSION['manager'] = true;
					unset($_SESSION['expert']);
					unset($_SESSION['user']);
					unset($_SESSION['email']);
					header("Location: admin_book.php");
				}
				else{
					//check if it is expert
					$query = "SELECT name,pass from expert";
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);
					if($name == $row['name'] && $pass == $row['pass'] ){
						$_SESSION['expert'] = true;
						unset($_SESSION['manager']);
						unset($_SESSION['user']);
						unset($_SESSION['email']);
						header("Location: admin_book.php");
					}
				else{
						//check if it is customer
						$query = "SELECT id, email,password from customers";
						$result = mysqli_query($conn, $query);
						for($i = 0; $i < mysqli_num_rows($result); $i++){
							$row = mysqli_fetch_assoc($result);
							if($name == $row['email'] && $pass == $row['password']){ 
								$_SESSION['user'] = true;	
								$_SESSION['email'] = $name;
								$id = $row['id'];
								unset($_SESSION['manager']);
								unset($_SESSION['expert']);

								if(!empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1){
									$key = md5(random_int(-9999, 9999));
									setcookie("id", $id, strtotime("+30 days"));
									setcookie("key", $key, strtotime("+30 days"));
									$query = "UPDATE customers SET cookie='$key' WHERE id='$id'";
									mysqli_query($conn, $query);
								}

								header("Location: index.php");
							}

						}
					}
				}
			}
	

	if(isset($conn)) {mysqli_close($conn);}
	
?>
