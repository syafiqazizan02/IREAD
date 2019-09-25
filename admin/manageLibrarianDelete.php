<?php

require_once('../connection/conn.php');

		if(isset($_GET['lib_id']))
		{

			$id = $_GET ["id"];
			$librarian_id = $_GET['lib_id'];
			
			$stmt = $conn->prepare("DELETE FROM librarian where librarian_id=?");
			$stmt->bind_param("s", $librarian_id);
			$stmt->execute();

			echo "<script>alert('Librarian Detail is Deleted!')</script>";
			echo "<script>window.location.href='manageLibrarian.php?id=$id';</script>";

		}

?>
