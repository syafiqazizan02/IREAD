<?php

 if(isset($_POST['submit']))
	{
		$done_id = $_POST['done_id'];


		include "db_conn.php";

		$stmt = $conn->prepare("SELECT g.done_id as done_id, g.done_date as done_date, e.member_ic as member_ic, e.member_fullname as member_fullname, e.member_email as member_email, e.member_contact as member_contact
                            FROM done AS g
                            JOIN member AS e ON e.member_id=g.member_id AND g.done_id=?");

		$stmt->bind_param("s", $done_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

			$done_id =  $row['done_id'];
			$done_date = $row['done_date'];
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

	<center><b>RETURN BOOK :</b>&nbsp;&nbsp;IDR<?php echo  $done_id; ?></center><br>

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
				<td style="border: 1px solid black;"><b>&nbsp;&nbsp;Return Date&nbsp;&nbsp;:&nbsp;&nbsp;</b></td>
			</tr>
      <tr height="30">
				<td style="border: 1px solid black;"  align="center" >&nbsp;&nbsp;<?php echo date_format(date_create($done_date), 'd F Y')?>&nbsp;&nbsp;</td>
			</tr>
		</table>
	</div><br><br><br><br><br><br>

			<div class="box-body table-responsive">

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<thead>
						  <tr align="center">
							<th >Book ID</th>
							<th >Book Title</th>
							<th>Book Category</th>
							<th >Book Author</th>
              <th>Borrow Date</th>
              <th>Return Date</th>
              <th>Penalty Days</th>
              <th>Penalty Amount</th>
						  </tr>
					   </thead>
						 <?php

				        include "db_conn.php";

				        $stmt2 = $conn->prepare("SELECT a.penalty_day as penalty_day, a.penalty_amount as penalty_amount, b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, c.borrow_date as borrow_date, c.due_date as due_date, d.category_name as book_category
                                         FROM `return` AS a
                                         JOIN book AS b ON a.book_id=b.book_id
                                         JOIN category AS d ON b.category_id=d.category_id
                                         JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                         JOIN done AS g ON a.done_id=g.done_id
                                         AND g.done_id =?");

				        $stmt2->bind_param("s", $done_id);
				        $stmt2->execute();
				        $result2 = $stmt2->get_result();

                $penaltyAmount = 0;

				          while($row2 = $result2->fetch_assoc())
				          {
				              $book_code = $row2['book_code'];
				              $book_tittle = $row2['book_tittle'];
				              $book_category = $row2['book_category'];
				              $book_author = $row2['book_author'];
                      $borrow_date = date_format(date_create($row2['borrow_date']), 'd M Y');
                      $due_date = date_format(date_create($row2['due_date']), 'd M Y  ');
                      $penalty_day= $row2['penalty_day'];
                      $penalty_amount = $row2['penalty_amount'];

				     ?>
					   <tbody>
              <tr align="center">
                 <td><?php echo $book_code ;?></td>
                 <td><?php echo $book_tittle ;?></td>
                 <td><?php echo $book_author ;?></td>
                 <td><?php echo $book_category ;?></td>
                 <td><?php echo $borrow_date ;?></td>
                 <td><?php echo $due_date ;?></td>
                 <td align="center">
                   <?php

                      if ($penalty_day == 0){

                        echo "No Penalty";

                      }else {

                        echo $penalty_day." Days";

                      }
                   ?>

                 </td>
                 <td  align="center">
                   <?php

                       if ($penalty_amount == 0){

                         echo "No Penalty";

                       }else {

                         echo "RM ".$penalty_amount;

                       }
                   ?>
                 </td>
  						  </tr>
							<?php

              $penaltyAmount += $penalty_amount;

            }?>
            <tr height="40">
             <td colspan="7"><p align="right" style="font-weight: bold; color:#000000;">Total :  &nbsp;&nbsp;</p></td>
             <td  align="center">
               <?php

                 if ($penalty_amount == 0){

                   echo "<b> 0 </b>";

                 }else {

                   echo "<b> RM ".$penaltyAmount."</b>";

                 }

               ?>
             </td>
           </tr>
						</tbody>
			</table>

	   <br><br><center>More information please contact : +606-553 2499.</center>

	<script>
		window.print();
	</script>

</body>
</html>
