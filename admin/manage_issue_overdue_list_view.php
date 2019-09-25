<table id="bootstrap-data-table4" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Book Code</th>
     <th>Book Title</th>
     <th>Book Category</th>
     <th>Book Author</th>
     <th>Days Overdue</th>
     <th>View</th>
   </tr>
 </thead>
 <tbody>
   <?php

      include "db_conn.php";

      $return_status = 0;

      $stmt2 = $conn->prepare("SELECT a.return_id as return_id, b.book_code as book_code, b.book_tittle as book_tittle,  b.book_author as book_author, c.borrow_date as borrow_date, c.due_date as due_date, d.category_name as book_category
      												 FROM `return` AS a
      												 JOIN book AS b ON a.book_id=b.book_id
      											   JOIN category AS d ON b.category_id=d.category_id
      												 JOIN borrow AS c ON a.borrow_id=c.borrow_id
      												 AND a.return_status=? AND c.due_date <= NOW() ORDER BY c.due_date ASC");

      $stmt2->bind_param("s", $return_status);
      $stmt2->execute();
      $result2 = $stmt2->get_result();

        while($row2 = $result2->fetch_assoc())
        {
            $return_id = $row2['return_id'];
            $book_code = $row2['book_code'];
            $book_tittle = $row2['book_tittle'];
            $book_category = $row2['book_category'];
            $book_author = $row2['book_author'];
            $borrow_date = date_format(date_create($row2['borrow_date']), 'Y-m-d');
            $due_date = date_format(date_create($row2['due_date']), 'Y-m-d');

            date_default_timezone_set("Asia/Kuala_Lumpur");
        		$now_date = date("Y-m-d");

             $date1 = new DateTime($now_date);
             $date2 = new DateTime($due_date);

             $diff = $date2->diff($date1)->format("%a");
             $days = intval($diff);
   ?>
   <tr align="center">
      <td><?php echo $book_code; ?></td>
      <td><?php echo $book_tittle; ?></td>
      <td><?php echo $book_category; ?></td>
      <td><?php echo $book_author; ?></td>
      <td>
        <p style="font-weight: bold;color:#d81515"><?php echo $days; ?> Days</p>
      </td>
      <td>
        <?php include('manage_issue_overdue_info_view.php'); ?>
				<a href="#viewover<?php echo $return_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class='fa fa-info-circle'></i></a>
      </td>
   </tr>
   <?php }?>
  </tbody>
</table>
