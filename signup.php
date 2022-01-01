<?php
	$title = "Регистрация";
	require_once "./template/header.php";
?>


<form class="form-row" method="post" action="user_signup.php">
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Имя</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Имя" name="firstname">
    </div>

    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Фамилия</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Фамилия" name="lastname">
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Email" name="email">
    </div>

    <div class="form-group col-md-6">
        <label for="inputZip">Номер телефона</label>
        <input type="text" class="form-control" id="inputZip" placeholder="Номер телефона" name="zipcode">
    </div>
  
    <div class="form-group col-md-6">
        <label for="inputAddress">Адрес</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Адрес" name="address">
    </div>

    <div class="form-group col-md-6">
        <label for="inputCity">Город</label>
        <input type="text" class="form-control" id="inputCity" placeholder="Город" name="city">
    </div>

    <div class="form-group col-md-6">
        <label for="inputPassword4 ">Пароль</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Пароль" name="password">
    </div>

    <div class="form-group col-md-6">
        <label for="inputPassword4 ">Повторите пароль</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Повторите пароль" name="password2">
    </div>

    <div class="form-group col-md-6">
	<label for="inputPassword4 ">Введите число</label>
        <input type="text" class="form-control" id="inputPassword4" placeholder="Введите число" name="captcha">
	<!--<input type="text" name="captcha">-->
	<img src="captcha.php"> 
    </div>

    <div class="form-group col-md-12">
    	<button type="submit" class="btn btn-danger">Зарегистироваться</button>
    </div>
</form>
<div style="position:fixed; bottom:120px">

<?php

    $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullurl,"signup=empty")==true){
        echo '<P style="color:red">Вы не заполнили все поля</P>';
        exit();
    }
    if(strpos($fullurl,"signup=invalidemail")==true){
        echo '<P style="color:red">Такого email не существует</P>';
        exit();
    }
?>
</div>
<?php


	require_once "./template/footer.php";

?>
