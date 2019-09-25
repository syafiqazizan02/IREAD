<?php

	if(isset($_POST['submit']))
	{
		$borrow_id = $_POST['borrow_id'];

		include "db_conn.php";

		$stmt = $conn->prepare("SELECT c.borrow_id as borrow_id, c.borrow_date as borrow_date, c.due_date as due_date, e.member_ic as member_ic, e.member_fullname as member_fullname, e.member_email as member_email, e.member_contact as member_contact
														FROM borrow AS c
														JOIN member AS e ON c.member_id=e.member_id AND c.borrow_id=?");
		$stmt->bind_param("s", $borrow_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

			$borrow_id =  $row['borrow_id'];
			$borrow_date = $row['borrow_date'];
			$due_date = $row['due_date'];
			$member_ic = $row['member_ic'];
			$member_fullname = $row['member_fullname'];
			$member_email = $row['member_email'];
			$member_contact = $row['member_contact'];
	}

?>
<html>
<head>
	<title>Library Management System</title>
</head>

<body>
	<br><br><center><img src="../images/logo.png" width="100px" height="80px"/><br><br>

	<div align="center">
		<b>SKPM Library</b><br>
		Sekolah Kebangsaan Parit Melana,<br>
		Jalan Alor Gajah Lama, 76100 Alor Gajah,<br>
		Melaka.
	</div><br>

	<center><b>BORROW BOOK :</b>&nbsp;&nbsp;IDB<?php echo  $borrow_id; ?></center><br>

	<div style="float:left;">
		<table>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;Member ID</b></td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td><?php echo $member_ic; ?></td>
			</tr>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;Member Name</b></td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td><?php echo $member_fullname; ?></td>
			</tr>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;Member Email</b></td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td><?php echo $member_email; ?></td>
			</tr>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;Member Contact</b></td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td>+6<?php echo $member_contact; ?></td>
			</tr>
		</table>
	</div>

	<div style="float:right;">
		<table>
			<tr height="30">
				<td style="border: 1px solid black;"><b>&nbsp;&nbsp;Borrow Date&nbsp;&nbsp;:&nbsp;&nbsp;</b></td>
				<td style="border: 1px solid black;"  align="center" >&nbsp;&nbsp;<?php echo date_format(date_create($borrow_date), 'd F Y')?>&nbsp;&nbsp;</td>
			</tr>
			<tr height="30">
				<td style="border: 1px solid black;"><b>&nbsp;&nbsp;Due Date&nbsp;&nbsp;:&nbsp;&nbsp;</b></td>
				<td style="border: 1px solid black;"  align="center" >&nbsp;&nbsp;<?php echo date_format(date_create($due_date), 'd F Y')?>&nbsp;&nbsp;</td>
			</tr>
		</table>
	</div><br><br><br><br><br><br>

			<div class="box-body table-responsive">

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<thead>
						  <tr>
							<th width="25%"><center>Book ID</center></th>
							<th width="25%"><center>Book Title</center></th>
							<th width="25%"><center>Book Category</center></th>
							<th width="25%"><center>Book Author</center></th>
						  </tr>
					   </thead>
						 <?php

				        include "db_conn.php";

				        $stmt2 = $conn->prepare("SELECT b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, c.borrow_date as borrow_date, c.due_date as due_date, d.category_name as book_category
						 	 													 FROM `return` AS a
						 	 		 											 JOIN book AS b ON a.book_id=b.book_id
						 	 		 											 JOIN category AS d ON b.category_id=d.category_id
						 	 		 											 JOIN borrow AS c ON a.borrow_id=c.borrow_id
						 	 													 AND a.borrow_id =?");

				        $stmt2->bind_param("s", $borrow_id);
				        $stmt2->execute();
				        $result2 = $stmt2->get_result();

				          while($row2 = $result2->fetch_assoc())
				          {
				              $book_code = $row2['book_code'];
				              $book_tittle = $row2['book_tittle'];
				              $book_category = $row2['book_category'];
				              $book_author = $row2['book_author'];

				     ?>
					   <tbody>
						  <tr align="center">
							<td width="20%"><?php echo $book_code; ?></td>
							<td width="20%"><?php echo $book_tittle; ?></td>
							<td width="20%"><?php echo $book_category; ?></td>
							<td width="20%"><?php echo $book_author; ?></td>
						  </tr>
							<?php }?>
						</tbody>
			</table>

	   <br><br><center>More information please contact : +606-553 2499.</center>

	<script>
		window.print();
	</script>

</body>
</html>
