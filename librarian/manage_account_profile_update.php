<?php
	include "db_conn.php";

		if(isset($_POST['submit']))
		{
			 $librarian_fullname = $_POST ['librarian_fullname'];
			 $librarian_email = $_POST['librarian_email'];
			 $librarian_contact = $_POST['librarian_contact'];
			 $librarian_address = $_POST['librarian_address'];
		   $librarian_favQues = $_POST['librarian_favQues'];
			 $librarian_favAnsw = $_POST['librarian_favAnsw'];

			 $librarian_id = $_POST ["librarian_id"];

			$stmt = $conn->prepare("UPDATE librarian SET  librarian_fullname=?, librarian_email=?, librarian_contact=?, librarian_address=?, librarian_favQues=?, librarian_favAnsw=?  WHERE librarian_id=?");
			$stmt->bind_param("sssssss", $librarian_fullname, $librarian_email, $librarian_contact, $librarian_address, $librarian_favQues, $librarian_favAnsw, $librarian_id);
			$stmt->execute();

				if($stmt == TRUE)
				{
					echo "<script>alert('Librarian Info is Updated Successful!')
							window.location.href='manage_account_profile_edit.php?id=$librarian_id';</script>";
				}
				else
				{
					echo "<script>alert('Librarian Info is Updated Failed!')
							window.location.href='manage_account_profile_edit.php?id=$librarian_id';</script>";
				}
		}
?>
