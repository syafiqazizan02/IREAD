<?php

	include('db_conn.php');

		if(isset($_POST['recovery']))
		{
			$librarian_id = $_POST['librarian_id'];

			$new_password = md5 ($_POST['new_password']);
			$confirm_password = md5 ($_POST['confirm_password']);

			if( $new_password == "" OR $confirm_password == "")
			{
				echo "<script>alert('Please fill in all Data!')</script>";
				echo "<script>window.open('recovery_password_page.php','_self')</script>";
			}
			else if($new_password!=$confirm_password)
			{
				echo "<script>alert('Your password are Not Same!')</script>";
				echo "<script>window.open('manage_account_password_change.php?id=$librarian_id','_self')</script>";
			}
			else
			{
				$stmt = $conn->prepare("UPDATE librarian SET librarian_password = ? WHERE librarian_id=?");
				$stmt->bind_param("ss", $new_password, $librarian_id);
				$stmt->execute();

					if($stmt)
					{
						echo "<script>alert('Password Recovery Successful!')</script>";
						echo "<script>window.open('../logout.php','_self')</script>";
					}
					else
					{
						echo "<script>alert('Password Recovery Failed!')</script>";
						echo "<script>window.open('manage_account_password_change.php?id=$librarian_id','_self')</script>";
					}
				}
		}

?>
