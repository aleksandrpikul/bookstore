<?php
	session_start();
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Checking out";
	require "./template/header.php";
	if(!isset($_SESSION['user'])){
		echo '<div class="alert alert-danger" role="alert">
		Вам нужно <a href="signin.php">войти</a>
	  </div>';
	}
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
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
			<td><?php echo $book['book_price']. " руб."; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $qty * $book['book_price'] . " руб."; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo $_SESSION['total_price'] . " руб."; ?></th>
		</tr>
	</table>
	<?php 
		if(isset($_SESSION['user'])){
			echo '<form method="post" action="purchase.php" class="form-horizontal">
			<div class="form-group" style="margin-left:0px">
				<input type="submit" name="submit" value="Купить" class="btn btn-danger" >
				<a href="cart.php" class="btn btn-danger">Изменить</a> 
			</div>
		</form>
		<p class="lead">Нажмите «Купить», чтобы подтвердить покупку, или «Изменить», чтобы добавить или удалить товары.</p>';
		}
	?>
	
<?php
	} else {
		echo "<p class=\"text-warning\">Ваша корзина пуста =(</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
