<table id="bootstrap-data-table" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Book Code</th>
     <th>Book Title</th>
     <th>Book Category</th>
     <th>Book Author</th>
     <th>Review</th>
   </tr>
 </thead>
 <tbody>
   <?php

        $return_status = 1;
        $nilam_status = 1;

        $stmt4 = $conn->prepare("SELECT a.return_id as return_id,b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, d.category_name as book_category
                                 FROM `return` AS a
                                 JOIN book AS b ON a.book_id = b.book_id
                                 JOIN category AS d ON b.category_id = d.category_id
                                 JOIN borrow AS c ON a.borrow_id = c.borrow_id
                                 JOIN member AS e ON c.member_id=e.member_id
                                 AND e.member_id=? AND a.return_status=? AND a.nilam_status=?");

        $stmt4->bind_param("sss", $member_id, $return_status, $nilam_status);
        $stmt4->execute();
        $result4 = $stmt4->get_result();

          while($row4 = $result4->fetch_assoc())
          {
            $return_id = $row4['return_id'];
            $book_code = $row4['book_code'];
            $book_tittle = $row4['book_tittle'];
            $book_category = $row4['book_category'];
            $book_author = $row4['book_author'];

   ?>
   <tr align="center">
     <td><?php echo $book_code ;?></td>
     <td><?php echo $book_tittle ;?></td>
     <td><?php echo $book_category ;?></td>
     <td><?php echo $book_author ;?></td>
     <td>
        <?php include('manage_member_teacher_nilam_detail.php'); ?>
        <a href="#nilam<?php echo $return_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class='fa fa-info-circle'></i></a>
   </tr>
    <?php } ?>
  </tbody>
 </table>
