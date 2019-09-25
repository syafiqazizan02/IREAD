<?php

  include "db_conn.php";

  if(isset($_POST["memberIC"]))
  {
   $member_ic = mysqli_real_escape_string($conn, $_POST["memberIC"]);

   $query = "SELECT * FROM `return` AS a JOIN book AS b ON a.book_id=b.book_id JOIN category AS d ON b.category_id=d.category_id JOIN borrow AS c ON a.borrow_id=c.borrow_id JOIN member AS e ON c.member_id=e.member_id AND a.return_status=0 AND c.due_date <= NOW() AND e.member_ic='".$member_ic."'";

   $result = mysqli_query($conn, $query);

   echo mysqli_num_rows($result);

  }
?>
