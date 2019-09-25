<table class="table table-striped table-bordered">
 <thead>
   <tr align="center">
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

        $return_status = 0;

        $total_all = 0;

        $stmt12 = $conn->prepare("SELECT a.return_status as return_status, b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, d.category_name as book_category, c.borrow_id as borrow_id, c.borrow_date as borrow_date, c.due_date as due_date
                                 FROM `return` AS a
                                 JOIN book AS b ON a.book_id = b.book_id
                                 JOIN category AS d ON b.category_id = d.category_id
                                 JOIN borrow AS c ON a.borrow_id = c.borrow_id
                                 JOIN member AS e ON c.member_id=e.member_id
                                 AND e.member_id=? AND a.return_status=?");

        $stmt12->bind_param("ss", $member_id, $return_status);
        $stmt12->execute();
        $result12 = $stmt12->get_result();

          while($row12 = $result12->fetch_assoc())
          {
            $book_code = $row12['book_code'];
            $book_tittle = $row12['book_tittle'];
            $book_category = $row12['book_category'];
            $book_author = $row12['book_author'];
            $return_status = $row12['return_status'];

            // $borrow_date = date_format(date_create($row12['borrow_date']), 'd M Y');
            // $due_date = date_format(date_create($row12['due_date']), 'd M Y');
            //
            // date_default_timezone_set("Asia/Kuala_Lumpur");
            // $now_date = date("Y-m-d");
            //
            //  $date1 = new DateTime($now_date);
            //  $date2 = new DateTime($due_date);
            //
            //  $diff = $date2->diff($date1)->format("%a");
            //  $days = intval($diff);

            $borrow_date = date_format(date_create($row12['borrow_date']), 'Y-m-d');
            $borrowdate = date_format(date_create($row12['borrow_date']), 'd M Y');

            $due_date = date_format(date_create($row12['due_date']), 'Y-m-d ');
            $duedate = date_format(date_create($row12['due_date']), 'd M Y');

            date_default_timezone_set("Asia/Kuala_Lumpur");
            $now_date = date("Y-m-d ");
            $nowdate = date("d M Y");

             $date1 = new DateTime($now_date);
             $date2 = new DateTime($due_date);

             $diff = $date2->diff($date1)->format("%a");
             $days = intval($diff);

   ?>
   <tr align="center">
     <td><?php echo $book_code ;?></td>
     <td><?php echo $book_tittle ;?></td>
     <td><?php echo $book_category ;?></td>
     <td><?php echo $book_author ;?></td>
     <td><?php echo $borrowdate; ?></td>
     <td><?php echo $duedate; ?></td>
     <td align="center">
       <?php

           if($due_date < $now_date){
             echo "<p style='color:red;'><b>".$days." Days Late</b></p>";
           }else {
              echo "<b>".$days." Days Lef</b>";
           }

         ?>
     </td>
     <td align="center">
       <?php

            $stmt13 = $conn->prepare("SELECT k.penalty_rate as penalty_rate
                                     FROM member AS e
                                     JOIN type AS k ON e.type_id = k.type_id
                                     AND e.member_id=?");

            $stmt13->bind_param("s", $member_id);
            $stmt13->execute();
            $result13 = $stmt13->get_result();
            $row13 = $result13->fetch_assoc();
                $penalty_rate= $row13 ['penalty_rate'];

                if($due_date < $now_date){

                    $total = ($days*$penalty_rate);

                  echo "<b><p style='color:red;'><b>RM ".$total."</b></p>";
                }
                else{

                  $total = 0;

                  echo "<b>No Penalty!</b>";
                }
         ?>
     </td>
   </tr>
  <?php

    $total_all += $total;

  }?>
   <tr>
     <td align="right" colspan="7"><b>Total : </b></td>
     <td align="center"><b><?php echo "<b> RM ".$total_all."</b>"; ?></b></td>
   </tr>
  </tbody>
</table>
