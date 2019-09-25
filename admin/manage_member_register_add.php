<?php

	include "db_conn.php";

	if(isset($_POST['submit']))
	{
			$member_ic = $_POST['member_ic'];
			$member_fullname = $_POST['member_fullname'];
			$member_gender = $_POST['member_gender'];
			$member_email = $_POST['member_email'];
			$member_password =  md5 ("000000");
			$member_contact = $_POST['member_contact'];
			$member_address = $_POST['member_address'];
			$member_position = $_POST['member_position'];

			$librarian_id = $_POST['librarian_id'];

			$stmt = $conn->prepare("SELECT * FROM type WHERE type_id=?");
			$stmt->bind_param("s", $member_position);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
				$member_limit = $row ['book_limit'];

			date_default_timezone_set('Asia/Kuala_Lumpur');
			$member_register =  date("Y/m/d");

			$stmt2 = $conn->prepare("INSERT INTO member (member_ic, member_fullname, gender_id, member_email, member_password, member_contact, member_address, member_limit, member_register, type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt2->bind_param("ssssssssss", $member_ic, $member_fullname, $member_gender, $member_email, $member_password, $member_contact, $member_address, $member_limit, $member_register, $member_position);
			$stmt2->execute();

			$stmt3 = $conn->prepare("SELECT * FROM member WHERE member_ic=?");
			$stmt3->bind_param("s", $member_ic);
			$stmt3->execute();
			$result3 = $stmt3->get_result();
			$row3 = $result3->fetch_assoc();
				$member_id = $row3 ['member_id'];

				if($stmt2!='' && $stmt3!='')
				{
					echo "<script> alert('Register Member is Successful!');
							window.location.href='manage_member_register_validation.php?id=$librarian_id&member_id=$member_id';</script>";
				}
				else
				{
					echo "<script> alert('Register Member is Failed!');
								window.location.href='manage_member_register_new.php.php?id=$librarian_id';</script>";
				}
	 	}
?>
