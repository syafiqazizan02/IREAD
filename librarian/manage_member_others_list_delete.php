<?php

	include "db_conn.php";

		if(isset($_GET['member_id']))
		{

			$id = $_GET ["id"];
			$member_id = $_GET['member_id'];

			$stmt = $conn->prepare("DELETE FROM member where member_id=?");
			$stmt->bind_param("s", $member_id);
			$stmt->execute();

			echo "<script>alert('Member Detail is Deleted!')</script>";
			echo "<script>window.location.href='manage_member_list_view.php?id=$id';</script>";

		}

?>
