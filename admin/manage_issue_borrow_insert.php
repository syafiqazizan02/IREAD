<?php

	include "db_conn.php";
	include "../php-mailer-master/PHPMailerAutoload.php";

		//Getting Member ID
		$member_id = $_POST['hidden_member_id'];

		//Borrow Date
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$borrow_date = date("Y-m-d H:i:s");

		//Checking Member Student Or Teacher(Days)
		$stmt1 = $conn->prepare("SELECT type_id FROM member WHERE member_id =?");
		$stmt1->bind_param("s", $member_id);
		$stmt1->execute();
		$result1 = $stmt1->get_result();
		$row1 = $result1->fetch_assoc();
			$type_id = $row1 ['type_id'];

		//Checking Days borrow_day_student or borrow_day_student
		$stmt2 = $conn->prepare("SELECT borrow_day FROM type WHERE type_id=?");
		$stmt2->bind_param("s", $type_id);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row2 = $result2->fetch_assoc();
			$borrow_day = $row2 ['borrow_day'];

		//Calculate one day to strstrtotime
		$duedate = ($borrow_day * 86400); // 1 Day = 86400

		//Due Date
		$borrowDateCon = strtotime($borrow_date);
		$borrowDateCal = ($borrowDateCon + $duedate);
		$due_date = date("Y-m-d H:i:s", $borrowDateCal);

		//Insert into TABLE BORROW
		$stmt3 = $conn->prepare("INSERT INTO borrow (member_id, borrow_date, due_date) VALUES ( ?, ?, ?)");
		$stmt3->bind_param("sss", $member_id, $borrow_date, $due_date);
		$stmt3->execute();

		//Select from TABLE BORROW (Geting borrow_id back)
		$stmt4 = $conn->prepare("SELECT * FROM borrow ORDER BY borrow_id DESC");
		$stmt4->execute();
		$result4 = $stmt4->get_result();
		$row4 = $result4->fetch_assoc();
			echo $borrow_id = $row4 ['borrow_id'];

		//Count Book_id
		$n =  $_POST['hidcount'];

		//Insert into TABLE RETURN
		for($i=1; $i <= $n; $i++)
		{
				//Getting Book ID
		  	$book_id = $_POST['hidden_book_id'.$i];

				$borrow_status = 0;

				$stmt5 = $conn->prepare("INSERT INTO `return` (book_id,borrow_id,return_status) VALUES ( ?, ?, ?)");
				$stmt5->bind_param("ssi", $book_id, $borrow_id, $borrow_status);
				$stmt5->execute();

				$book_status = 1;

				$stmt6 = $conn->prepare("UPDATE `book` SET `book_status`= ? WHERE book_id =?");
				$stmt6->bind_param("ss", $book_status, $book_id);
				$stmt6->execute();
		}

		//Get Previous Member Book Limit
		$stmt7 = $conn->prepare("SELECT member_limit FROM member WHERE member_id=?");
		$stmt7->bind_param("s", $member_id);
		$stmt7->execute();
		$result7 = $stmt7->get_result();
		$row7 = $result7->fetch_assoc();
			$member_limit= $row7 ['member_limit'];

		//Calculate Borrow Limit Left (Previous Limit - Book Amount)
		$new_limit = ($member_limit - $n);

		//Update New Book Limit
		$stmt8 = $conn->prepare("UPDATE `member` SET `member_limit`= ? WHERE member_id =?");
		$stmt8->bind_param("ss", $new_limit, $member_id);
		$stmt8->execute();

		//Geting Borrow Member Info -- RETURN TABLE
		$stmt9 = $conn->prepare("SELECT c.borrow_date as borrow_date, c.due_date as due_date, e.member_fullname as member_fullname, e.member_email as member_email
														 FROM `return` AS a
														 JOIN borrow AS c ON a.borrow_id=c.borrow_id
														 JOIN member AS e ON c.member_id=e.member_id
														 AND c.borrow_id=? ");
		$stmt9->bind_param("s", $borrow_id);
		$stmt9->execute();
		$result9 = $stmt9->get_result();
		$row9 = $result9->fetch_assoc();
			$borrow_date = date_format(date_create($row9['borrow_date']), 'd F Y');
			$due_date = date_format(date_create($row9['due_date']), 'd F Y  ');
			$member_fullname = $row9 ['member_fullname'];
			$member_email = $row9 ['member_email'];

		 //PHPMailerAutoload to Gmail
 		 $mail = new PHPMailer;
 		 $mail->isSMTP();
 		 $mail->Host = 'smtp.gmail.com';
 		 $mail->SMTPAuth = true;
 		 $mail->Username = 'skpmlibrary@gmail.com';
 		 $mail->Password = 'skpm2018';
 		 $mail->SMTPSecure = false;
 		 $mail->Port = 587;
 		 $mail->setFrom('skpmlibrary@gmail.com', 'SKPM Library');
 		 $mail->addAddress($member_email);
 		 $mail->isHTML(true);
 		 $mail->Subject = 'Borrow Book Transaction';
 		 $mail->Body    = '<p><h3>Congratulation!</h3><b>Your transaction is Successful. Borrow IDB'.$borrow_id.'</b></p>
 											 <p>Member Name: '.$member_fullname.'<br>
 												Borrow Date: '.$borrow_date.'<br>
 												Due Date: '.$due_date.'</p>
 											 <p>More information please contact : +606-553 2499.</p>';
 		 $mail->AltBody = '<p><h3>Congratulation!</h3><b>Your transaction is Successful. Borrow IDB'.$borrow_id.'</b></p>
 											 <p>Member Name: '.$member_fullname.'<br>
 												Borrow Date: '.$borrow_date.'<br>
 												Due Date: '.$due_date.'</p>
 											 <p>More information please contact : +606-553 2499.</p>';
 		 $mail->send();

?>
