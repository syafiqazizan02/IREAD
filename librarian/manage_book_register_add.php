<?php

	include "db_conn.php";

	if(isset($_POST['submit']))
	{
			$book_copies = $_POST['book_copies'];

			for ($x = 1; $x <= $book_copies ; $x++) {

				$book_tittle = $_POST['book_tittle'];
				$book_category = $_POST['book_category'];
				$book_author = $_POST['book_author'];
				$book_publisher = $_POST['book_publisher'];
				$book_year = $_POST['book_year'];
				$book_isbn = $_POST['book_isbn'];
				$book_price = $_POST['book_price'];
				$book_shelf = $_POST['book_shelf'];

				date_default_timezone_set('Asia/Kuala_Lumpur');
				$book_receive = date("Y/m/d");

				$bookCode = ($book_isbn."-".$x);
				$book_code = $bookCode;

				$librarian_id = $_POST['librarian_id'];

				$stmt = $conn->prepare("INSERT INTO book (book_code, book_isbn, book_tittle, category_id, book_author, book_publisher, book_year, book_receive, book_price, shelf_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssssssss", $book_code, $book_isbn, $book_tittle, $book_category, $book_author, $book_publisher, $book_year, $book_receive, $book_price, $book_shelf);
				$stmt->execute();

			}

				if($stmt)
				{
					echo "<script> alert('New Book is Successful!');
							window.location.href='manage_book_list_view.php?id=$librarian_id';</script>";
				}
				else
				{
					echo "<script> alert('New Book is Failed!');
								window.location.href='manage_book_register_new.php.php?id=$librarian_id';</script>";
				}
	 	}
?>
