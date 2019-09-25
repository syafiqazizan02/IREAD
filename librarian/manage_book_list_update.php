<?php
	include "db_conn.php";

		if(isset($_POST['submit']))
		{

			$book_isbn = $_POST ['book_isbn'];

			$book_tittle = $_POST ['book_tittle'];
			$book_author = $_POST['book_author'];
			$book_publisher = $_POST['book_publisher'];
			$book_year = $_POST['book_year'];
			$book_price = $_POST['book_price'];

			$librarian_id = $_POST ["librarian_id"];

			$stmt = $conn->prepare("UPDATE book SET  book_tittle=?, book_author=?, book_publisher=?, book_year=?, book_price=? WHERE book_isbn=?");
			$stmt->bind_param("ssssss", $book_tittle, $book_author, $book_publisher, $book_year, $book_price, $book_isbn);
			$stmt->execute();

				if($stmt)
				{
					echo "<script>alert('Book Info is Successful Updated!')
							window.location.href='manage_book_list_view.php?id=$librarian_id';</script>";
				}
				else
				{
					echo "<script>alert('Book Info is Failed Updated!')
							window.location.href='manage_book_list_view.php?id=$librarian_id';</script>";
				}
		}
?>
