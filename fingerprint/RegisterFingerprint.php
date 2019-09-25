<?php
    require_once("DatabaseConnection.php");

    if(isset($_POST)){
        $varFN = $_REQUEST["selectFn"];
        if($varFN == "searchData"){
            if($_REQUEST["MemberFinger"]!="" && $_REQUEST["MemberID"]!=""){
                $strMemberFinger = $_REQUEST["MemberFinger"];
				$strMemberID = $_REQUEST["MemberID"];	
                $strQry = 'UPDATE member SET member_finger="'.$strMemberFinger.'" WHERE member_id='.$strMemberID.'';
                $stmt = $conn->prepare($strQry);
                $stmt->execute();
            }
        }
    }
?>