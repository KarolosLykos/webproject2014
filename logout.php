<?php
	session_name("karolos_session");
	session_start();
	session_unset(); 
	session_destroy();
	header("Location: index.php");	
?>