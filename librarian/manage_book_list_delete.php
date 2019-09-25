<?php

	include "db_conn.php";

		if(isset($_GET['book_isbn']))
		{
			$id = $_GET ["id"];
			$book_isbn = $_GET['book_isbn'];

				$stmt = $conn->prepare("DELETE FROM book where book_isbn=?");
				$stmt->bind_param("s", $book_isbn);
				$stmt->execute();

					echo "<script>alert('Book Detail is Successful Deleted!')</script>";
					echo "<script>window.location.href='manage_book_list_view.php?id=$id';</script>";
		}else{

			echo "<script>alert('Book Detail is Failed Deleted!')</script>";
			echo "<script>window.location.href='manage_book_list_view.php?id=$id';</script>";

		}

?>
