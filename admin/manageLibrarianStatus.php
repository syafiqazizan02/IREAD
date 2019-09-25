<?php
include 'dbLibrarian.php';
if(isset($_POST['submitStatus'])){
    updateLibrarianStatus();
}else{
    echo "<script>document.location='manageLibrarian.php';</script>";
}
?>