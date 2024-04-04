<?php
	session_start();				//retrieve session
	session_destroy();				//then destroy it
	header("Location: index.html");	//redirect to login page
	exit;
?>
