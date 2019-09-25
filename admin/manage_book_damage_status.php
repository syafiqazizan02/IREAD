<?php

  include "db_conn.php";

    if(isset($_POST['cancel'])){

      $id = $_POST['id'];
      $book_id = $_POST['book_id'];

      $book_remark = 0;
      $book_damage = 0;

        $stmt = $conn->prepare("UPDATE book SET book_remark =?, book_damage =? WHERE book_id=?");
        $stmt->bind_param("sss", $book_remark, $book_damage, $book_id);
        $stmt->execute();

          if($stmt){

            echo "<script>alert('Undo Damage Book is Successful!')
                window.location.href='manage_book_damage_list.php?id=$id';</script>";
          }else
          {
            echo "<script>alert('Undo Damage Book is Failed!')
                window.location.href='manage_book_damage_list.php?id=$id';</script>";
          }
        }

 ?>
