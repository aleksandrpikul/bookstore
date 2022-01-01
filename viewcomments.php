<?php
require('connect.php');
 
	$sql = "SELECT * FROM comments";
	$res = mysqli_query($connection, $sql);
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >
 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
 
 
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Comments</div>
			<table class="table table-striped"> 
				<thead> 
					<tr> 
						<th>#</th> 
						<th>Content Title</th> 
						<th>Name</th> 
						<th>Comment</th> 
						<th>Time</th> 
						<th>Status</th> 
						<th>Operations</th> 
					</tr> 
				</thead> 
				<tbody> 
				<?php
					while ( $r = mysqli_fetch_assoc($res)) {
				?>
					<tr> 
						<th scope="row"><?php echo $r['id']; ?></th> 
						<td><?php echo $r['cid']; ?></td> 
						<td><?php echo $r['name'] ?></td> 
						<td><?php echo $r['subject']; ?></td> 
						<td><?php echo $r['submittime']; ?></td> 
						<td><?php if(isset($r['status']) & !empty($r['status'])){echo $r['status'];}else{echo "NA";} ?></td> 
						<td><a href="editcomment.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=publish">App</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=draft">Dis</a> <a href="delcomment.php?id=<?php echo $r['id']; ?>">Del</a></td> 
					</tr> 
				<?php } ?>
				</tbody> 
			</table>
		</div>
 
	</div>
</div>
</body>
</html>
