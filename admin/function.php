<?php

  function librarian(){

    include "db_conn.php";

      $id = $_REQUEST['id'];

        $stmt = $conn->prepare("SELECT * FROM librarian WHERE librarian_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

          $librarian_fullname = $row ['librarian_fullname'];

          echo $librarian_fullname;
  }

  function borrow(){

   include "db_conn.php";

    $return_status = 0;

      $stmt1 = $conn->prepare("SELECT count(1) FROM `return` AS a
                               JOIN book AS b ON a.book_id=b.book_id
                               JOIN category AS d ON b.category_id=d.category_id
                               JOIN borrow AS c ON a.borrow_id=c.borrow_id
                               AND a.return_status=? AND c.due_date >= NOW()");

      $stmt1->bind_param("s", $return_status);
      $stmt1->execute();
      $result1 = $stmt1->get_result();
      $row1 = $result1->fetch_row();

        $total = $row1[0];

          echo $total." Books";
  }

  function overdue(){

   include "db_conn.php";

    $returnStatus = 0;

      $stmt2 = $conn->prepare("SELECT count(1) FROM `return` AS a
                              JOIN book AS b ON a.book_id=b.book_id
                              JOIN category AS d ON b.category_id=d.category_id
                              JOIN borrow AS c ON a.borrow_id=c.borrow_id
                              AND a.return_status=? AND c.due_date <= NOW()");

      $stmt2->bind_param("s", $returnStatus);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      $row2 = $result2->fetch_row();

        $total = $row2[0];

          echo $total." Books";
  }

  function damage(){

	   include "db_conn.php";

  		$book_remark = 1;

  			$stmt3 = $conn->prepare("SELECT count(1) FROM book WHERE book_remark=?");
  			$stmt3->bind_param("s", $book_remark);
  			$stmt3->execute();
  			$result3 = $stmt3->get_result();
  			$row3 = $result3->fetch_row();

  				$total = $row3[0];

  					echo $total." Books";
  }


    $date = date('Y', time());

    function member(){

      global $date;
      include "db_conn.php";

        $stmt1 = $conn->prepare('SELECT COUNT(1) FROM member
        WHERE YEAR(member_register) = '.$date.'');
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_row();

        $total = $row1[0];

          echo $total." Members";
    }

    function nilam(){

      global $date;
      include "db_conn.php";

        $stmt1 = $conn->prepare('SELECT COUNT(1) FROM `return`
        JOIN done ON `return`.done_id = done.done_id
        WHERE YEAR(done_date) = '.$date.' AND `return`.nilam_status=1');
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_row();

        $total = $row1[0];

          echo $total." Reviews";

    }

    function penalty(){

      global $date;
      include "db_conn.php";

        $stmt1 = $conn->prepare('SELECT sum(penalty_amount) as b FROM `return`
        JOIN done ON `return`.done_id = done.done_id
        WHERE YEAR(done_date) = '.$date.' AND `return`.penalty_amount>0');
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_row();

        $total = $row1[0];

          echo "RM ".$total;
    }


 ?>
