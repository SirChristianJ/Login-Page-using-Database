<?php

//Define your host here.
$hostname = "localhost";

//Define your database username here.
$username = "jimenez";

//Define your database password here.
$password = "christian0855";

//Define your database name here.
$dbname = "jimenez_site";

 $conn = mysql_connect($hostname, $username, $password);
 
 if (!$conn)
 
 {
	 
 die('Could not connect: ' . mysql_error());
 
 }
 
 mysql_select_db($dbname, $conn);



?>