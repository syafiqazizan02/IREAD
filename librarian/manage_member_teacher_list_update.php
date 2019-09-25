<?php

	include "db_conn.php";

		if(isset($_POST['submit']))
		{

			$member_ic = $_POST ['member_ic'];
			$member_fullname = $_POST ['member_fullname'];
			$member_email = $_POST ['member_email'];
			$member_contact = $_POST ['member_contact'];
      $member_address = $_POST ['member_address'];

			$member_id = $_POST['member_id'];
			$librarian_id = $_POST ["librarian_id"];

			$stmt = $conn->prepare("UPDATE member SET  member_ic=?, member_fullname=?,  member_email=?, member_contact=?, member_address=? WHERE member_id=?");
			$stmt->bind_param("ssssss", $member_ic, $member_fullname, $member_email, $member_contact, $member_address, $member_id);
			$stmt->execute();

				if($stmt)
				{
					echo "<script>alert('Member Detail is Updated!')</script>";
					echo "<script>window.location.href = 'manage_member_list_view.php?id=$librarian_id'</script>";
				}
				else
				{
					echo "<script>alert('Member Detail Failed Updated!')</script>";
					echo "<script>window.location.href = 'manage_member_list_view.php?id=$librarian_id'</script>";
				}
		}
?>
