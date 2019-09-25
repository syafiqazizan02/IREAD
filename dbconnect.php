<?PHP

    $db = mysqli_connect("localhost","root","","skpm");

    //check connection
    if (!$db)
    {
      die("Connection failed: " . mysqli_connect_error());
    }


?>
