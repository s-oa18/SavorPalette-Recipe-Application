<?php
	session_start();				//retrieve session
	session_destroy();				//then destroy it
	header("Location: index.php");	//redirect to login page
	exit;
?>
