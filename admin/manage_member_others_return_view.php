<table  id="bootstrap-data-table1" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Return Date</th>
     <th>Book ID</th>
     <th>Book Title</th>
     <th>Book Category</th>
     <th>Book Author</th>
     <th>Borrow Date</th>
     <th>Due Date</th>
     <th>Return Info</th>
     <th>Return Penalty</th>
   </tr>
 </thead>
 <tbody>
   <?php

        $return_status = 1;

        $penaltyAmount = 0;

        $stmt20 = $conn->prepare("SELECT a.return_status as return_status, a.penalty_day as penalty_day, a.penalty_amount as penalty_amount, b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, d.category_name as book_category,
                                  c.borrow_id as borrow_id, c.borrow_date as borrow_date, c.due_date as due_date, f.done_date as done_date
                                  FROM `return` AS a
                                  JOIN book AS b ON a.book_id = b.book_id
                                  JOIN category AS d ON b.category_id = d.category_id
                                  JOIN borrow AS c ON a.borrow_id = c.borrow_id
                                  JOIN done AS f ON a.done_id = f.done_id
                                  JOIN member AS e ON c.member_id=e.member_id
                                  AND e.member_id=? AND a.return_status=? ORDER BY f.done_date DESC");

        $stmt20->bind_param("ss", $member_id, $return_status);
        $stmt20->execute();
        $result20 = $stmt20->get_result();

          while($row20 = $result20->fetch_assoc())
          {
            $book_code = $row20['book_code'];
            $book_tittle = $row20['book_tittle'];
            $book_category = $row20['book_category'];
            $book_author = $row20['book_author'];
            $return_status = $row20['return_status'];
            $penalty_day= $row20['penalty_day'];
            $penalty_amount = $row20['penalty_amount'];
            $borrow_date = date_format(date_create($row20['borrow_date']), 'd M Y');
            $due_date = date_format(date_create($row20['due_date']), 'd M Y');
            $done_date = date_format(date_create($row20['done_date']), 'd M Y');

            date_default_timezone_set("Asia/Kuala_Lumpur");
            $now_date = date("Y-m-d");

             $date1 = new DateTime($now_date);
             $date2 = new DateTime($due_date);

             $diff = $date2->diff($date1)->format("%a");
             $days = intval($diff);

   ?>
   <tr align="center">
     <td><?php echo $done_date; ?></td>
     <td><?php echo $book_code ;?></td>
     <td><?php echo $book_tittle ;?></td>
     <td><?php echo $book_category ;?></td>
     <td><?php echo $book_author ;?></td>
     <td><?php echo $borrow_date; ?></td>
     <td><?php echo $due_date; ?></td>
     <td align="center">
       <?php

          if ($penalty_day == 0){

            echo "<b>No Penalty</b>";

          }else {

            echo "<p style='color:red;'><b>".$penalty_day." Days Late</b></p>";

          }

       ?>
     </td>
     <td align="center">
       <?php

           if ($penalty_amount == 0){

             echo "<b>No Penalty</b>";

           }else {

            echo "<p style='color:red;'><b>RM ".$penalty_amount."</b></p>";

           }
       ?>
     </td>
   </tr>
  <?php
  }?>
  </tbody>
</table>
