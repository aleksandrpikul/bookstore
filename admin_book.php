<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "List book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>	
	<div>
	<a href="admin_signout.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Выйти</a>
	<a href="admin_publishers.php" class="btn btn-danger"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Издательства</a>
	<a href="admin_categories.php" class="btn btn-danger"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Категории</a>
	<?php
	if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-danger" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Добавить книги</a>';
	}
	?>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Название</th>
			<th>Автор</th>
			<th>Изображение</th>
			<th>Описание</th>
			<th>Цена</th>
			<th>Издательство</th>
			<th>Категория</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_image']; ?></td>
			<td><?php echo $row['book_descr']; ?></td>
			<td><?php echo $row['book_price']; ?></td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
			<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
			<?php
				if( isset($_SESSION['expert']) && $_SESSION['expert']==true){
					echo '<td><a href="admin_edit.php?bookisbn=';
					echo $row['book_isbn'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>Редактировать</a></td>';
				}else if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
					echo '<td><a href="admin_delete.php?bookisbn=';
					echo $row['book_isbn']; 
					echo '"><span class="glyphicon glyphicon-trash"></span>Удалить</a></td>';
				}
			?>

		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
