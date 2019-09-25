<table id="bootstrap-data-table5" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Return Date</th>
     <th>Book Code</th>
     <th>Book Title</th>
     <th>Book Category</th>
     <th>Book Author</th>
     <th>Penalty Date</th>
     <th>Penalty Amount</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
   <?php

      include "db_conn.php";

      $return_status = 1;

      $stmt1 = $conn->prepare("SELECT g.done_date as done_date, a.return_id as return_id, a.penalty_day as penalty_day, a.penalty_amount as penalty_amount, b.book_code as book_code, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author
                               FROM `return` AS a
                               JOIN book AS b ON a.book_id=b.book_id
                               JOIN category AS d ON b.category_id=d.category_id
                               JOIN done AS g ON a.done_id=g.done_id
                               AND a.return_status=?  ");

      $stmt1->bind_param("s", $return_status);
      $stmt1->execute();
      $result1 = $stmt1->get_result();

        while($row1 = $result1->fetch_assoc())
        {
            $done_date = date_format(date_create($row1['done_date']), 'd M Y');
            $return_id = $row1['return_id'];
            $book_code = $row1['book_code'];
            $book_tittle = $row1['book_tittle'];
            $book_category = $row1['book_category'];
            $book_author = $row1['book_author'];
            $penalty_day= $row1['penalty_day'];
            $penalty_amount = $row1['penalty_amount'];


   ?>
   <tr align="center">
      <td><?php echo $done_date; ?></td>
      <td><?php echo $book_code; ?></td>
      <td><?php echo $book_tittle; ?></td>
      <td><?php echo $book_category; ?></td>
      <td><?php echo $book_author; ?></td>
      <td align="center">
        <?php

           if ($penalty_day == 0){

             echo "<p style='color:#000000;'><b>No Penalty</b></p>";

           }else {

             echo "<p style='font-weight:bold; color:#d81515'>".$penalty_day." Days Late</p>";

           }
        ?>
      </td>
      <td align="center">
        <?php

            if ($penalty_amount == 0){

               echo "<p style='color:#000000;'><b>No Penalty</b></p>";

            }else {

              echo "<p style='font-weight:bold; color:#d81515'>RM ".$penalty_amount."</p>";

            }
        ?>
      </td>
      <td>
        <?php include('manage_issue_return_info_view.php'); ?>
				<a href="#viewreturn<?php echo $return_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class='fa fa-info-circle'></i></a>
      </td>
   </tr>
   <?php }?>
  </tbody>
</table>
