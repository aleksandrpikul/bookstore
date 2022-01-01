<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Оформление покупки";
	require "./template/header.php";
	// connect database
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
    ?>
	<table class="table">
		<tr>
			<th>Название</th>
			<th>Цена</th>
	    	<th>Количество</th>
	    	<th>Сумма</th>
	    </tr>
	    	<?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
		<tr>
			<td><?php echo $book['book_title'] . ". " . $book['book_author']; ?></td>
			<td><?php echo $book['book_price']  . " руб."; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $qty * $book['book_price']  . " руб."; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo $_SESSION['total_price']  . " руб."; ?></th>
		</tr>
		<tr>
			<td>Доставка</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>20.00</td>
		</tr>
		<tr>
			<th>Общая сумма, включая доставку</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo ($_SESSION['total_price'] + 20)  . " руб."; ?></th>
		</tr>
	</table>
	<br>
	<br>
	<h4 style="margin-left:-20px">Ваши данные</h4>
	<br>
<form method="post" action="process.php" class="form-row">

	<div class="form-group col-md-6">
		<label for="exampleInputEmail1">Имя</label>
		<input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
        </div>

        <div class="form-group col-md-6">
		<label for="exampleInputEmail1">Фамилия</label>
		<input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
        </div>

        <div class="form-group col-md-6">
		<label for="inputAddress">Адрес</label>
		<input type="text" class="form-control" id="inputAddress" value="<?php echo $customer['address']?>" name="address">
        </div>

        <div class="form-group col-md-6">
		<label for="inputCity">Город</label>
		<input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer['city']?>">
        </div>

        <div class="form-group col-md-6">
		<label for="inputZip">Номер телефона</label>
		<input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer['zipcode']?>">
        </div>
	<br>

    <div class="form-group" >
        <div class="form-group" >
            <div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
              	<button type="reset" class="btn btn-default">Отмена</button>
              	<button type="submit" class="btn btn-danger">Купить</button>
            </div>
        </div>
   </form>
<?php
	} else {
		echo "<p class=\"text-warning\">Ваша корзина пуста =(</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
