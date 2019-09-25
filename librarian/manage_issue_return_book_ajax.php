<?php

	include "db_conn.php";

		$book_return = $_REQUEST['book_return'];

		$sql = mysqli_query($conn, "SELECT book_id FROM book WHERE book_code = '$book_return'");
		$fetch = mysqli_fetch_assoc($sql);
			$book_id = $fetch ['book_id'];

			$query = mysqli_query($conn, "SELECT a.return_id as return_id, b.book_id as book_id, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, c.borrow_date as borrow_date, c.due_date as due_date, f.penalty_rate as penalty_rate
																		FROM `return` AS a
																		JOIN book AS b ON a.book_id=b.book_id
																		JOIN category AS d ON b.category_id=d.category_id
																		JOIN borrow AS c ON a.borrow_id=c.borrow_id
																		JOIN member AS e ON c.member_id=e.member_id
																		JOIN type AS f ON e.type_id=f.type_id
																		AND a.book_id='$book_id' AND a.return_status=0");

			$data = mysqli_fetch_assoc($query);

			$return_id = $data['return_id'];
			$book_tittle = $data['book_tittle'];
			$book_category = $data['book_category'];
			$book_author = $data['book_author'];
			$borrow_date = $data['borrow_date'];
			$due_date = $data['due_date'];
			$penalty_rate = $data['penalty_rate'];
			$book_id = $data['book_id'];

			echo json_encode($data);

?>
