<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);
error_reporting(E_ALL);
	session_start();
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Profile";
	require "./template/header.php";
	// connect database
	if(isset($_SESSION['email'])){
	$customer = getCustomerIdbyEmail($_SESSION['email']);
?>

    <form method="post" action="profile.php" class="form-row">
	    <div class="col-md-3 text-center">
		<img class="img-responsive img-thumbnail " src="./bootstrap/users_images/<?php echo $customer['userfile']; ?>">
	    </div>
    </form>


    <form method="post" action="editProfile.php" class="form-row">
	<div class="form-group col-md-4">
	    <label for="exampleInputEmail1">Имя</label>
	    <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Фамилия</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['email']?>" name="email">
        </div>

        <div class="form-group col-md-4">
            <label for="inputAddress">Адрес</label>
            <input type="text" class="form-control" id="inputAddress" value="<?php echo $customer['address']?>" name="address">
        </div>
    
        <div class="form-group col-md-4">
            <label for="inputCity">Город</label>
            <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer['city']?>">
        </div>
 
        <div class="form-group col-md-4">
            <label for="inputZip">Номер телефона</label>
            <input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer['zipcode']?>">
        </div>
	<div class="btn-group form-group col-md-4">
	    <button type="submit" class="btn btn-danger">Сохранить</button>
       	    <button type="reset" class="btn btn-danger">Отмена</button>
	</div>
    </form>

<form method="post" action="download_img.php" enctype="multipart/form-data">
	    <div class="form-group col-md-10"> 
                    <input type="submit" class="btn btn-danger" name="save" value="Обновить">
		    <input type="file" name="imageupload">
		   <!-- <input type="submit" name="delete" value="submit"> -->
	    </div>
</form>



<?php
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
