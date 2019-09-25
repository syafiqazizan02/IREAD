<?php
include "dbconnect.php";

if (isset($_POST['submitnil'])) {

  $submitnilam = mysql_real_escape_string($_POST['submitnilam']);
  $return_id = $_POST['return_id'];

  $sql = "UPDATE `return` SET nilam_status=1, nilam_desc ='$submitnilam' WHERE return_id='$return_id'";
  mysqli_query($db, $sql);

  echo "<script>alert('Successful Review Nilam!')
      window.location.href='nilam.php';</script>";

}
?>
