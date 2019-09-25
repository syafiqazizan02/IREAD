<html>
  <head>
  	<title>Library Management System</title>
  </head>
  <style>
    .div {
        width: 600px;
        border: 1px solid black;
    }
  </style>
<body>

<?php

  include "db_conn.php";

    $id = $_GET["id"];

    if(isset($_POST['select']))
    {

      if(!empty($_POST["selectlist"]))
      {

         echo "<h1 align='center'>Generate Barcode</h1><br>";

        foreach($_POST["selectlist"] as $book_id)
        {

          $stmt = $conn->prepare("SELECT book_code, book_tittle FROM book WHERE book_id=?");
    			$stmt->bind_param("s", $book_id);
    			$stmt->execute();
    			$result = $stmt->get_result();
    			$row = $result->fetch_assoc();
    				$book_code = $row ['book_code'];
            $book_tittle = $row ['book_tittle'];

           $text = $book_code;

            echo "<center>
                    <div class='div'>
                        <p align='right'>$book_tittle&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><img alt='testing' src='manage_book_barcode_generate.php?codetype=Code128&size=40&text=".$text."&print=true'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </div>
                  </center><br>";

        }

          echo "<script>window.print();</script>";

        }
        else
        {
          echo "<script>alert('No Book Selected!')</script>";
          echo "<script>window.close()</script>";
        }

     }

?>

</body>
</html>
