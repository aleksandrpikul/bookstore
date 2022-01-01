<?php

	session_start();
	require_once "./functions/database_functions.php";
	require_once "./functions/cart_functions.php";
	$conn = db_connect();
	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that bookisbn => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

	// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			}
		}
	}
	
	if(isset($_POST['clear_cart'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
		        $_POST[$isbn] == '0';
		        unset($_SESSION['cart']["$isbn"]);
		}
	}


	// print out header here
	$title = "Ваша корзина покупок";
	require "./template/header.php";

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
   	<form action="cart.php" method="post">
	   	<table class="table">
	   		<tr>
	   			<th>Название товара</th>
	   			<th>Цена за шт.</th>
	  			<th>Количество</th>
	   			<th>Итоговая цена</th>
	   		</tr>
	   		<?php
		    	foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
			<tr>
				<td><?php echo $book['book_title'] . ". " . $book['book_author']; ?></td>
				<td><?php echo $book['book_price'] . " руб."; ?></td>
				<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
				<td><?php echo $qty * $book['book_price'] . " руб."; ?></td>
			</tr>
			<?php } ?>
		    <tr>
		    	<td><b>ИТОГО</b></td>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['total_items']; ?></th>
		    	<th><?php echo $_SESSION['total_price'] . " руб."; ?></th>
		    </tr>
	   	</table>
		   <button type="submit" class="btn btn-danger" name="save_change"><span class="glyphicon glyphicon-ok"></span>&nbsp;Сохранить изменения</button>
		   <button class="btn btn-danger" name="clear_cart">Очистить корзину</button>
	  
	</form>
	<br/><br/>
	<a href="checkout.php" class="btn btn-danger">Перейти к оформлению</a> 
	<a href="books.php" class="btn btn-danger">Вернуться к товарам</a>
<?php
	} else {
		echo "<div class=\"text-center\">
  			<img src=\"/bootstrap/img/imgonline-com-ua-Resize-IfdicwlWWpWrOjao.png\" class=\"rounded\" alt=\"...\">

			<h1 class=\"display-1 text-center\">Ваша корзина пуста =(</h1>

			
				<h1 class=\"display-6 text-center\">Воспользуйтесь нашим <a href=\"books.php\">каталогом</a>, чтобы ее заполнить. У нас всегда есть, что почитать!</h1>
	 		

			
		      </div>";


	}
	if(isset($_SESSION['user'])){
	$customer=getCustomerIdbyEmail($_SESSION['email']);
	$customerid=$customer['id'];
	$query="SELECT * FROM cart join cartitems join books join customers
		on customers.id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and  cartitems.productid=books.book_isbn";
	 $result=mysqli_query($conn,$query);
	 if(mysqli_num_rows($result)!=0){
	 echo '	<br><br><br><h4>История покупок</h4><table class="table">
	 <tr>
		 <th>Item</th>
		 <th>Quantity</th>
		<th>Date</th>
	 </tr>';
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			
			while($query_row = mysqli_fetch_assoc($result)){
				echo '<tr>
				<td>
				<a href="book.php?bookisbn=';
				echo $query_row['book_isbn'];
				echo '">';
				echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="./bootstrap/img/';
				echo $query_row['book_image'];
				echo '">';
				echo ' </a>
				</td>
				<td>';
				echo $query_row['quantity'];
				echo '
				</td>
				<td>';
				echo $query_row['date'];
				echo'
				</td>
				</tr>';
			}
		}
		echo '</table>';
	}
}
?>
<?php	 
	if(isset($conn)){ mysqli_close($conn); }
	// require_once "./template/footer.php";?>
