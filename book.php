<?php
  ini_set('display_errors',1);
  error_reporting(E_ALL ^E_NOTICE);
  error_reporting(E_ALL);

  session_start();
  $book_isbn = $_GET['bookisbn'];
  // connec to database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }

  $title = $row['book_title'];

  require "./template/header.php";
?>
      <!-- Example row of columns -->
      <p class="lead" style="margin: 25px 0"><a href="books.php">Книги</a> > <?php echo $row['book_title']; ?></p>

      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
        </div>

        <div class="col-md-6">
          <h4>Описание</h4>
          <p><?php echo $row['book_descr']; ?></p>
          <h4>Детали</h4>
          <table class="table">
              <?php foreach($row as $key => $value){
                  if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                    continue;
                  }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Название";
                  break;
                case "book_author":
                  $key = "Автор";
                  break;
                case "book_price":
                  $key = "Цена";
                  break;
              }
              ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>


          <form method="post" action="cart.php">
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <input type="submit" value="Добавить в корзину" name="cart" class="btn btn-danger">
          </form>
<div class="panel-heading"></div>


<!-- (D) ADD NEW COMMENT -->
<?php
require('connect.php');
 
if(isset($_POST) & !empty($_POST)){
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$subject = mysqli_real_escape_string($connection, $_POST['subject']);
 
	$isql = "INSERT INTO comments (book_isbn, name, email, subject) VALUES ('$book_isbn', '$name', '$email', '$subject')";
	$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
}

?>
<form method="post">
		<div class="panel panel-warning">
		<div class="panel-heading">Оставить комментарий</div>
		  <div class="panel-body">
		  	  <div class="form-group col-md-6">
			    <label for="exampleInputEmail1">Имя</label>
			    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
			  </div>

			  <div class="form-group col-md-6">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>

			  <div class="form-group col-md-12">
			    <label for="exampleInputPassword1">Комментарий</label>
			    <textarea name="subject" class="form-control" rows="3"></textarea>
			  </div>

			  <button type="submit" name="upload" class="btn btn-danger">Отправить</button>
		</div>
		</div>
</form>

<?php
require('connect.php');
  $conn = db_connect();

  $query = "SELECT * FROM comments WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Оставьте первый комментарий";
    exit;
  }
?>
		<div class="panel panel-warning">
			<div class="panel-heading">Комментарии</div>
			<table class="table table-warning"> 
				<thead class="table-warning"> 
					<tr class="table-warning">
						<th>Имя</th> 
						<th>Комментарий</th>  
					</tr> 
				</thead> 
				<tbody class="table-warning"> 
				<?php while ( $row = mysqli_fetch_assoc($result)) { ?>
					<tr class="table-warning"> 
						<td><?php echo $row['name'] ?></td> 
						<td><?php echo $row['subject']; ?></td>  
					</tr> 
				<?php } ?>
				</tbody> 
			</table>
		
		</div>
<?php
  require "./template/footer.php";
?>
