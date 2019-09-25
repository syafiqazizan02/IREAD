<?php

	include "db_conn.php";

		$book_code = $_REQUEST['book_code'];

		$query = mysqli_query($conn, "SELECT b.book_id as book_id, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_author as book_author
																	FROM book AS b
																	JOIN category AS d ON b.category_id=d.category_id AND b.book_code='$book_code' AND b.book_status=0 AND book_remark=0");

		$data = mysqli_fetch_assoc($query);

		$book_tittle = $data['book_tittle'];
		$book_category = $data['book_category'];
		$book_author = $data['book_author'];
		$book_id = $data['book_id'];

		echo json_encode($data);

?>
