<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once "./functions/database_functions.php";
    if(isset($_SESSION['email'])){
      $customer = getCustomerIdbyEmail($_SESSION['email']);
      $name=$customer['firstname'];
    }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://bootstraptema.ru/plugins/2016/bootsnav/bootsnav.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://bootstraptema.ru/plugins/2016/bootsnav/bootsnav.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
/* demo background */
body{
background: #660033;
background: -webkit-linear-gradient(to right, #ffcc66, #ffcc66);
background: linear-gradient(to right, #ffcc66, #ffcc66);
}

</style>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
  </head>

  <body>
<nav class="navbar navbar-white bg-primary navbar navbar-inverse navbar-fixed-top navbar"  > 
      <div class="container">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div style="width: 400px; " >
          <div class="row">
            <a class="navbar-brand" href="index.php" col-md-3>Bookstore</a>
            <form  method="post" action="search_book.php" class="col-md-6" style="margin-top:7px">
              <input type="text" class="form-control" id="inputPassword2" placeholder="Поиск" name="text">
              <button type="submit" class="btn btn-primary mb-2" style="display:none"></button>
           </form>
          </div>
          </div>
        </div>

        <!--/.navbar-collapse -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <!-- link to publiser_list.php -->
              <li><a href="publisher_list.php"><span class="glyphicon glyphicon-paperclip"></span>&nbsp; Издательства</a></li>
              <li><a href="category_list.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Категории</a></li>
              <!-- link to books.php --><li><a href="books.php"><span class="glyphicon glyphicon-book"></span>&nbsp; Книги</a></li>
              <!-- link to shopping cart -->
              <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Корзина</a></li>
              <?php 
               if(isset($_SESSION['user'])){
                 echo ' <li><a href="logout.php"><span class="	glyphicon glyphicon-log-out"></span>&nbsp; Выход</a></li>'.'<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;'
                 .$name.
                 '</a></li>';
               }else{
                echo ' <li><a href="signin.php"><span class="	glyphicon glyphicon-log-in"></span>&nbsp; Вход</a></li>'.'<li><a href="signup.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Регистрация</a></li>';
               }

              ?>

            </ul>
        </div>
      </div>
    </nav>
    <?php
      if(isset($title) && $title == "BOOKSTORE") {
    ?>

<!--
<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <div class="carousel-inner">

        <div class="item active">
            <img class="d-block w-1" src="bootstrap/img/imgonline-com-ua-Resize-nc1LFNYby6Y1KQrH.jpg" />
        </div>

        <div class="item">
            <img class="d-block w-1" src="bootstrap/img/slider-image-3-1920x700.jpg" class="img-responsive" />
        </div>
    </div>

    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
-->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img class="d-block w-10" src="bootstrap/img/imgonline-com-ua-Resize-w8dwpUA71sZ.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
	      <div class="container">
	      </div>    
            </div>
        </div>
        <div class="item">
            <img class="d-block w-10" src="bootstrap/img/slider-image-2-1920x700.jpg" alt="Second slide">
        </div>
        <div class="item">
            <img class="d-block w-10" src="bootstrap/img/slider-image-3-1920x700.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    <!-- Main jumbotron for a primary marketing message or call to action 

<div class="jumbotron" style="  background: url('https://c1.wallpaperflare.com/preview/24/497/242/books-stack-red-library.jpg') no-repeat center center;background-size: cover; height:400px;" >
      <div class="container">
        <h1 style="text-align:right; margin:2% auto;">BOOKSTORE</h1>
        <p style="text-align:right; margin:1% auto;">Любимые книги онлайн</p>     
      </div>
    </div>-->
    <?php } ?>  

    <div class="container" id="main">
