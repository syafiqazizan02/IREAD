<?php

	include "db_conn.php";

		// $member_ic = $_REQUEST['member_ic'];
		//
		// $query = mysqli_query($conn, "SELECT member_id, member_ic, member_fullname, member_email, member_contact, member_limit FROM member WHERE member_ic = '$member_ic'");
		//
		// $data = mysqli_fetch_assoc($query);
		//
		// $member_fullname = $data['member_fullname'];
		// $member_email = $data['member_email'];
		// $member_contact = $data['member_contact'];
		// $member_limit= $data['member_limit'];
		// $member_id = $data['member_id'];
		//
		// echo json_encode($data);

		
		$member_id = $_REQUEST['member_id'];

		$query = mysqli_query($conn, "SELECT member_id, member_ic, member_fullname, member_email, member_contact, member_limit FROM member WHERE member_id = '$member_id'");

		$data = mysqli_fetch_assoc($query);

		$member_ic = $data['member_ic'];
		$member_fullname = $data['member_fullname'];
		$member_email = $data['member_email'];
		$member_contact = $data['member_contact'];
		$member_limit= $data['member_limit'];
		$member_id = $data['member_id'];

		echo json_encode($data);

?>
