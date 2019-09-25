<?php

    $libraian_id = $_GET["id"];
    $member_id = $_GET["member_id"];

    //Create Socket
     $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

     //If Socket Failed
     if (!$socket) { die("socket_create failed.\n"); }

     //Bind Socket
     if( !socket_bind($socket, "127.0.0.1" , 8073) )
     {
         $errorcode = socket_last_error();
         $errormsg = socket_strerror($errorcode);

         if($errorcode==10048){

           echo "<script>alert('Please Re-Open Fingerprint Apps!')</script>";
           echo "<script>window.open('manage_member_register_validation.php?id=$libraian_id&member_id=$member_id','_self')</script>";

         }

     }else{

       //Receive some data
       $r = socket_recvfrom($socket, $buf, 7, 0, $remote_ip, $remote_port);
       socket_close($socket);

        if($buf == "success"){

          echo "<script>alert('Register Fingerprint is Successful!')</script>";
          echo "<script>window.open('manage_member_list_view.php?id=$libraian_id&member_id=$buf','_self')</script>";

        }else if($buf == "failed1"){

          //DELETE Member_ID ??
          echo "<script>alert('Register Fingerprint is Failed!')</script>";
          echo "<script>window.open('manage_member_register_validation.php?id=$libraian_id&member_id=$member_id','_self')</script>";

        }else if($buf == "cancel1"){

          echo "<script>alert('Fingerprint Duplicated because already Registered!')</script>";
          echo "<script>window.open('manage_member_register_validation.php?id=$libraian_id&member_id=$member_id','_self')</script>";

        }else {

        }
    }

    //Close Socket
    socket_close($socket);

?>
