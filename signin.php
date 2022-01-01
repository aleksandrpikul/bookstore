<?php
	$title = "Вход";
	require_once "./template/header.php";
	$conn = db_connect();
	
	// если есть сохраненные куки, то выполняется подстановка ключа и id, и выполняется вход 
	if(!empty($_COOKIE['id']) and !empty($_COOKIE['key'])){
			$id = $_COOKIE['id']; 
			$key = $_COOKIE['key'];
			$query = "SELECT * FROM customers WHERE id='$id' AND cookie='$key'";

			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);

			// если сохраненный в куки ключ совпадает с ключем из БД, то ыполняется вход и генерация нового ключа для куки
			if(!empty($row)){
				session_start(); 
				$_SESSION['user'] = true; 
				$_SESSION['email'] = $row['email'];
				
				$key = md5(random_int(-9999, 9999));
				setcookie("id", $id, strtotime("+30 days"));
				setcookie("key", $key, strtotime("+30 days"));
				$query = "UPDATE customers SET cookie='$key' WHERE id='$id'";
				mysqli_query($conn, $query);
				
				header("Location: index.php");
			}
		}
?>
	<form class="form-row" method="post" action="user_verify.php">
  		<div class="form-group col-md-12">
    			<label for="exampleInputEmail1">Email</label>
    			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" placeholder="Email" name="username">
  		</div>
  
  		<div class="form-group col-md-6">
    			<label for="exampleInputPassword1">Пароль</label>
    			<input type="password" class="form-control form-control-reg" placeholder="Пароль" name="password">
    		</div>
  
  		<div class="form-group col-md-6">
    			<label for="exampleInputPassword1">Повторите пароль</label>
    			<input type="password" class="form-control form-control-reg" placeholder="Пароль" name="password2">
    		</div>

                <div class="form-horizontal col-md-12">
			<button type="submit" class="btn btn-danger">Войти</button>
			<label><input type='checkbox' name='remember' value='1'>Запомнить меня</label>
		</div>
	</form>

	<div>
		<?php $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    		if(strpos($fullurl,"signin=empty")==true){
        		echo '<br><P style="color:red">Заполните все поля, пожалуйста.</P>';
        		exit();
    		}
    		if(strpos($fullurl,"signin=invaliduser")==true){
        		echo '<br><P style="color:red">Не верное имя пользователя или пароль.</P>';
        		exit();
    		} ?>
	</div>

<?php
	require_once "./template/footer.php";
?>
