<?php

      function pendingbBook(){

        include "db_conn.php";

        $return_status = 0;

        $member_id = $_GET["member_id"];

          $stmt13 = $conn->prepare("SELECT count(1) FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN borrow c ON a.borrow_id = c.borrow_id
                                    JOIN member AS e ON c.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=?");

          $stmt13->bind_param("ss", $member_id, $return_status);
          $stmt13->execute();
          $result13 = $stmt13->get_result();
          $row13 = $result13->fetch_row();

            $total = $row13[0];

              echo $total." Books";
      }

      function totalPenalty(){

        include "db_conn.php";

        $return_status = 1;

        $member_id = $_GET["member_id"];

          $stmt14 = $conn->prepare("SELECT SUM(a.penalty_amount)
                                    FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN done g ON a.done_id = g.done_id
                                    JOIN member AS e ON g.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=?");

          $stmt14->bind_param("ss", $member_id, $return_status);
          $stmt14->execute();
          $result14 = $stmt14->get_result();
          $row14 = $result14->fetch_row();

            $total = $row14[0];

              if($total==0){
                echo "RM 0";
              }else{
                echo "RM ".$total;
              }
      }

      function recentBook(){

        include "db_conn.php";

        $return_status = 1;

        $member_id = $_GET["member_id"];

          $stmt15 = $conn->prepare("SELECT count(1) FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN done g ON a.done_id = g.done_id
                                    JOIN member AS e ON g.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=?");

          $stmt15->bind_param("ss", $member_id, $return_status);
          $stmt15->execute();
          $result15 = $stmt15->get_result();
          $row15 = $result15->fetch_row();

            $total = $row15[0];

              echo $total." Books";
      }

      function totalNilam(){

        include "db_conn.php";

        $return_status = 1;
        $nilam_status = 1;

        $member_id = $_GET["member_id"];

          $stmt16 = $conn->prepare("SELECT count(1) FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN done g ON a.done_id = g.done_id
                                    JOIN member AS e ON g.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=? AND a.nilam_status=?");

          $stmt16->bind_param("sss", $member_id, $return_status, $nilam_status);
          $stmt16->execute();
          $result16 = $stmt16->get_result();
          $row16 = $result16->fetch_row();

            $total = $row16[0];

              echo $total." Books";
      }

 ?>
