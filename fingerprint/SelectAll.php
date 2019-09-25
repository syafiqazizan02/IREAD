<?php
	require_once("DatabaseConnection.php");

	if(isset($_POST)){
		$varFN = $_REQUEST["selectAll"];
		if($varFN == "all"){
			if(isset($_REQUEST["member"]) && $_REQUEST["member"]=="member"){
				$strQry = 'SELECT * FROM member';
				$stmt = $conn->prepare($strQry);
				$stmt->execute();
				$result = $stmt->get_result();
				$outp = $result->fetch_all(MYSQLI_ASSOC);
				echo json_encode($outp);
			}
		}
	}
?>