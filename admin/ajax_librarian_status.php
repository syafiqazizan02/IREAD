<?php
include '../connection/conn.php';

if(isset($_POST["id"]))
{

 foreach($_POST["id"] as $id)
 {
    $sql = "SELECT librarian_id,librarian_status FROM librarian WHERE librarian_id=$id";
    $result=$conn->query($sql);
    while($row = $result->fetch_assoc()){
        if($row['librarian_status']==0){
            $query = "UPDATE librarian SET librarian_status=1 WHERE librarian_id ='".$id."'";
        }else if($row['librarian_status']==1){
            $query = "UPDATE librarian SET librarian_status=0  WHERE librarian_id ='".$id."'";
        }
        if($conn->query($query)===TRUE){

        }else{
            echo "<script>alert('".$conn->error."');
            document.location='manageLibrarian.php';
            </script>";
        }
    }
 }
}else{
    echo "<script>alert('System Error!');
    document.location='manageLibrarian.php';
    </script>";
}

?>
