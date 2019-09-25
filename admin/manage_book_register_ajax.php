<?php

  include "db_conn.php";

    if(isset($_POST["category_id"]) && !empty($_POST["category_id"]))
    {
        $query = $conn->query("SELECT * FROM 	shelf WHERE category_id = ".$_POST['category_id']."");

        $rowCount = $query->num_rows;

        if($rowCount > 0)
        {
            echo '<option value="">Select Shelf</option>';

            while($row = $query->fetch_assoc())
            {
                echo '<option value="'.$row['shelf_id'].'">'.$row['shelf_no'].'</option>';
            }
        }
        else
        {
            echo '<option value="">Shelf Not Available</option>';
        }
    }

?>
