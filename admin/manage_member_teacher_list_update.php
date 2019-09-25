<?php

	include "db_conn.php";

		if(isset($_POST['submit']))
		{

			$member_id = $_POST['member_id'];
			$member_password = md5('000000');

			$librarian_id = $_POST ["librarian_id"];

			$stmt = $conn->prepare("UPDATE member SET member_password=? WHERE member_id=?");
			$stmt->bind_param("ss", $member_password, $member_id);
			$stmt->execute();

				if($stmt)
				{
					echo "<script>alert('Reset Password Successfully!')</script>";
					echo "<script>window.location.href = 'manage_member_list_view.php?id=$librarian_id'</script>";
				}
				else
				{
					echo "<script>alert('Reset Password Failed!')</script>";
					echo "<script>window.location.href = 'manage_member_list_view.php?id=$librarian_id'</script>";
				}
		}
?>
