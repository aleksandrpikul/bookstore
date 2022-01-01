<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM category ORDER BY category_name";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty category ! Something wrong! check again";
		exit;
	}

	$title = "Категории";
	require "./template/header.php";
?>
<h1 class="display-1 text-center">КАТЕГОРИИ</h1>

	<ul>


	<?php while($row = mysqli_fetch_assoc($result)){
		$count = 0; 
		$query = "SELECT categoryid FROM books";
		$result2 = mysqli_query($conn, $query);
		if(!$result2){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		while ($pubInBook = mysqli_fetch_assoc($result2)){
			if($pubInBook['categoryid'] == $row['categoryid']){
				$count++;
			}
		}

?>

 <a href="bookPerCat.php?catid=<?php echo $row['categoryid']; ?>" class="list-group-item list-group-item-action list-group-item-warning"> <?php echo $row['category_name']; ?> <span class="badge"><?php echo $count; ?></span></a> 



</li>
<?php } ?>
		
			<a href="books.php" class="list-group-item list-group-item-action list-group-item-warning">Полный список книг</a>
		
	</ul> 
<?php 
	mysqli_close($conn);
	require "./template/footer.php";
?>
