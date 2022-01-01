<?php
//First check if everything is filled in
if(/*some statements*/)
{
//Do a mysql_real_escape_string() to all fields

//Then insert comment
mysql_query("INSERT INTO comments VALUES ($author,$postid,$body,$etc)");
}
else
{
die("Fill out everything please. Mkay.");
}
?>

