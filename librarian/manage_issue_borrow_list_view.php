<table id="bootstrap-data-table3" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Book Code</th>
     <th>Book Title</th>
     <th>Book Category</th>
     <th>Book Author</th>
     <th>Days Left</th>
     <th>View</th>
   </tr>
 </thead>
 <tbody>
   <?php

      include "db_conn.php";

      $return_status = 0;

      $stmt = $conn->prepare("SELECT a.return_id as return_id, b.book_code as book_code, b.book_tittle as book_tittle,  b.book_author as book_author, c.borrow_date as borrow_date, c.due_date as due_date, d.category_name as book_category
      												FROM `return` AS a
      												JOIN book AS b ON a.book_id=b.book_id
      												JOIN category AS d ON b.category_id=d.category_id
      												JOIN borrow AS c ON a.borrow_id=c.borrow_id
      												AND a.return_status=? AND c.due_date >= NOW() ORDER BY c.due_date ASC");

      $stmt->bind_param("s", $return_status);
      $stmt->execute();
      $result = $stmt->get_result();

        while($row = $result->fetch_assoc())
        {
            $return_id = $row['return_id'];
            $book_code = $row['book_code'];
            $book_tittle = $row['book_tittle'];
            $book_category = $row['book_category'];
            $book_author = $row['book_author'];
            $borrow_date = date_format(date_create($row['borrow_date']), 'Y-m-d');
            $due_date = date_format(date_create($row['due_date']), 'Y-m-d');

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
        <p style="color:#000000;"><b><?php echo $days;?> Days</b></p>
      </td>
      <td>
        <?php include('manage_issue_borrow_info_view.php'); ?>
				<a href="#viewborrow<?php echo $return_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class='fa fa-info-circle'></i></a>
      </td>
   </tr>
   <?php }?>
  </tbody>
</table>
