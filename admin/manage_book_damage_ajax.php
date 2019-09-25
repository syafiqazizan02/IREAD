<?php

  include "db_conn.php";

    if(isset($_POST["id"]))
    {
     foreach($_POST["id"] as $id)
     {

      $query = "UPDATE book SET book_remark=1, book_damage= NOW() WHERE book_id ='".$id."'";

      mysqli_query($conn, $query);

     }
    }

?>
