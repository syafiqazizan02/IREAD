<?php

	session_start();

	if(isset($_SESSION['id']))
	{
		$id = $_SESSION['id'];
	}
	else
	{
		header('location:../index.php');
	}

?>
