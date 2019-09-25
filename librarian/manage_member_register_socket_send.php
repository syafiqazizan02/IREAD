<?php

  //Getting Member_Id
  $st = $_POST["MemberID"];

  //Create Socket
  $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    //If Socket Failed
    if (!$socket) { die("Socket Create Failed.\n"); }

      $length=strlen($st);

      //Send some data
      socket_sendto($socket, $st, 12, 0, "127.0.0.1", 8080);

    //Close Socket
    socket_close($socket);

?>
