<?php

	include "db_conn.php";
	include "function.php";

	if(isset($_POST['recovery']))
	{

		$email = $_POST['email'];

		if($email!='')
		{

			$stmt = $conn->prepare("SELECT *FROM librarian WHERE librarian_email=?");
			$stmt->bind_param("s", $email);
			$stmt->execute();

			if($stmt->fetch())
			{
					session_start ();

					recoveryLibrarian();
			}
			else
			{
				$stmt2 = $conn->prepare("SELECT * FROM admin WHERE admin_email=?");
				$stmt2->bind_param("s", $email);
				$stmt2->execute();

				if($stmt2->fetch())
				{
					session_start ();

					recoveryAdmin();
				}
				else
				{
					$stmt3 = $conn->prepare("SELECT * FROM member WHERE member_email=?");
					$stmt3->bind_param("s", $email);
					$stmt3->execute();

					if($stmt3->fetch())
					{
							session_start ();

							recoveryMember();
					}
					else
					{
						echo "<script>alert('Your Email is Not Valid!')</script>";
						echo "<script>window.location.href='recovery_email_page.php';</script>";
					}
				}
			}
		}
		else
		{
			echo "<script>alert('Please enter your Email!')</script>";
			echo "<script>window.location.href='recovery_email_page.php';</script>";
		}

	}

?>
