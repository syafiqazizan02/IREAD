<?php

	include "db_conn.php";

	if(isset($_POST['recovery']))
	{

		$username = $_POST['username'];

		if($username!='')
		{

			$stmt = $conn->prepare("SELECT *FROM librarian WHERE librarian_username=?");
			$stmt->bind_param("s", $username);
			$stmt->execute();

			if($stmt->fetch())
			{
        session_start();

        $_SESSION['username'] = $username;

        echo "<script>window.location.href='recovery_librarian_page.php';</script>";

			}
			else
			{
				$stmt2 = $conn->prepare("SELECT * FROM admin WHERE admin_username=?");
				$stmt2->bind_param("s", $username);
				$stmt2->execute();

				if($stmt2->fetch())
				{
          echo "<script>alert('Please recovery using Email!')</script>";
          echo "<script>window.location.href='recovery_email_page.php';</script>";
				}
				else
				{
					$stmt3 = $conn->prepare("SELECT * FROM member WHERE member_ic=?");
					$stmt3->bind_param("s", $username);
					$stmt3->execute();

					if($stmt3->fetch())
					{
            session_start();

            $_SESSION['username'] = $username;

            echo "<script>window.location.href='recovery_member_page.php';</script>";
					}
					else
					{
						echo "<script>alert('Your Member ID is Not Valid!')</script>";
						echo "<script>window.location.href='recovery_username_page.php';</script>";
					}
				}
			}
		}
		else
		{
			echo "<script>alert('Please enter your Member ID!')</script>";
			echo "<script>window.location.href='recovery_member_page.php.php';</script>";
		}

	}

?>
