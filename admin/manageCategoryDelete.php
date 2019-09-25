<?php

require_once('../connection/conn.php');

		if(isset($_GET['cat_id']))
		{

			// $id = $_GET ["id"];
			$cat_id = $_GET['cat_id'];
			
			$stmt = $conn->prepare("DELETE FROM category where category_id=?");
			$stmt->bind_param("s", $cat_id);
			$stmt->execute();

			echo "<script>alert('Category Detail is Deleted!')</script>";
			echo "<script>window.location.href='manageCategory.php';</script>";

		}

?>
