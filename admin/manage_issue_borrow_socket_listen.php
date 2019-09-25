<?php

  $libraian_id = $_GET["id"];

  //Create Socket
  if(!($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)))
  {
      $errorcode = socket_last_error();
      $errormsg = socket_strerror($errorcode);

  }

  //Bind Socket
  if( !socket_bind($sock, "127.0.0.1" , 8078) )
  {
      $errorcode = socket_last_error();
      $errormsg = socket_strerror($errorcode);

      if($errorcode==10048){

        echo "<script>alert('Please Open Fingerprint Apps!')</script>";
        echo "<script>window.open('manage_issue_borrow_view.php?id=$libraian_id','_self')</script>";

      }

  }

  //Receive some data
  $r = socket_recvfrom($sock, $buf, 100, 0, $remote_ip, $remote_port);

  //Socket Close
  socket_close($sock);

      echo "<script>window.open('manage_issue_borrow_view.php?id=$libraian_id&member_id=$buf','_self')</script>";

?>
