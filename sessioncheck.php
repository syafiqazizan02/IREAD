<?php

	session_start();

	if(isset($_SESSION['username']))
	{
		$id = $_SESSION['username'];
	}
	else
	{
		header('location:./');
	}

?>
