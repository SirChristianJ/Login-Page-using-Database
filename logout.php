<?php

	echo "Logged out scuccessfully";
    
    session_start();
	session_destroy();
	setcookie(session_id(),time()-1);
	
	header("location:index.php");

?>