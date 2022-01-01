<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM publisher ORDER BY publisherid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty publisher ! Something wrong! check again";
		exit;
	}

	$title = "Список книг";
	require "./template/header.php";
?>
	<h1 class="display-1 text-center">ИЗДАТЕЛЬСТВА</h1>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT publisherid FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				if($pubInBook['publisherid'] == $row['publisherid']){
					$count++;
				}
			}
	?>




<a href="bookPerPub.php?pubid=<?php echo $row['publisherid']; ?>" class="list-group-item list-group-item-action list-group-item-warning"> <?php echo $row['publisher_name']; ?> <span class="badge"><?php echo $count; ?></span></a>



		
	
	<?php } ?>
		

<a href="books.php" class="list-group-item list-group-item-action list-group-item-warning">Полный список книг</a>


	
		
	</ul>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>
