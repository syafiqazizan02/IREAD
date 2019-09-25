<?php

      function pendingbBook(){

        include "db_conn.php";

        $return_status = 0;

        $member_id = $_GET["stud_id"];

          $stmt9 = $conn->prepare("SELECT count(1)
                                   FROM `return` AS a
                                   JOIN book AS b ON a.book_id = b.book_id
                                   JOIN category AS d ON b.category_id = d.category_id
                                   JOIN borrow c ON a.borrow_id = c.borrow_id
                                   JOIN member AS e ON c.member_id=e.member_id
                                   AND e.member_id=? AND a.return_status=?");

          $stmt9->bind_param("ss", $member_id, $return_status);
          $stmt9->execute();
          $result9 = $stmt9->get_result();
          $row9 = $result9->fetch_row();

            $total = $row9[0];

              echo $total." Books";
      }

      function totalPenalty(){

        include "db_conn.php";

        $return_status = 1;

        $member_id = $_GET["stud_id"];

          $stmt10 = $conn->prepare("SELECT SUM(a.penalty_amount)
                                    FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN done g ON a.done_id = g.done_id
                                    JOIN member AS e ON g.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=?");

          $stmt10->bind_param("ss", $member_id, $return_status);
          $stmt10->execute();
          $result10 = $stmt10->get_result();
          $row10 = $result10->fetch_row();

            $total = $row10[0];

              if($total==0){
                echo "RM 0";
              }else{
                echo "RM ".$total;
              }

      }

      function recentBook(){

        include "db_conn.php";

        $return_status = 1;

        $member_id = $_GET["stud_id"];

          $stmt11 = $conn->prepare("SELECT count(1)
                                   FROM `return` AS a
                                   JOIN book AS b ON a.book_id = b.book_id
                                   JOIN category AS d ON b.category_id = d.category_id
                                   JOIN done g ON a.done_id = g.done_id
                                   JOIN member AS e ON g.member_id=e.member_id
                                   AND e.member_id=? AND a.return_status=?");

          $stmt11->bind_param("ss", $member_id, $return_status);
          $stmt11->execute();
          $result11 = $stmt11->get_result();
          $row11 = $result11->fetch_row();

            $total = $row11[0];

              echo $total." Books";
      }

      function totalNilam(){

        include "db_conn.php";

        $return_status = 1;
        $nilam_status = 1;

        $member_id = $_GET["stud_id"];

          $stmt12 = $conn->prepare("SELECT count(1)
                                    FROM `return` AS a
                                    JOIN book AS b ON a.book_id = b.book_id
                                    JOIN category AS d ON b.category_id = d.category_id
                                    JOIN done g ON a.done_id = g.done_id
                                    JOIN member AS e ON g.member_id=e.member_id
                                    AND e.member_id=? AND a.return_status=? AND a.nilam_status=?");

          $stmt12->bind_param("sss", $member_id, $return_status, $nilam_status);
          $stmt12->execute();
          $result12 = $stmt12->get_result();
          $row12 = $result12->fetch_row();

            $total = $row12[0];

              echo $total." Books";
      }

 ?>
