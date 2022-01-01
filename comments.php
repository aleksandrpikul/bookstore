<?php 

    $email =mysql_real_escape_string($_GET['email']);
    $username = mysql_real_escape_string($_GET['username']);
    $content = mysql_real_escape_string($_GET['content']);

    $connect = mysql_connect("server","name","password");
    if (!$con) {die('Unable to connect..!!';}
    mysql_select_db("database", $connect);

    $query = "insert into Comments values (1,'" . $email 
    ."', '" . $username . "', '". $content . "')";

    mysql_query($query);
    mysql_close();

?>

