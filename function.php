<?php

 function Username(){

   $email = $_POST['email'];

   return $email;
 }

 function generatePassword($length = 6) {

   $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   $count = mb_strlen($chars);

   for ($i = 0, $result = ''; $i < $length; $i++) {
     $index = rand(0, $count - 1);
     $result .= mb_substr($chars, $index, 1);
   }
    return $result;
 }

  function recoveryLibrarian(){

    include "db_conn.php";
    require 'php-mailer-master/PHPMailerAutoload.php';

    $email = Username();
    $recovery = generatePassword();

    $stmt4 = $conn->prepare("SELECT * FROM librarian WHERE librarian_email=?");
    $stmt4->bind_param("s", $email);
    $stmt4->execute();
    $result4 = $stmt4->get_result();
    $row4 = $result4->fetch_assoc();
      $librarian_fullname = $row4 ['librarian_fullname'];
      $librarian_email = $row4 ['librarian_email'];
      $librarian_password = $row4 ['librarian_password'];

      date_default_timezone_set('Asia/Kuala_Lumpur');
      $datetime = date("d F Y H:i");
      $generate = md5 ($recovery);
        $stmt7 = $conn->prepare("UPDATE librarian SET librarian_password = ? WHERE librarian_email=?");
        $stmt7->bind_param("ss", $generate, $librarian_email);
        $stmt7->execute();

          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'skpmlibrary@gmail.com';
          $mail->Password = 'skpm2018';
          $mail->SMTPSecure = false;
          $mail->Port = 587;
          $mail->setFrom('skpmlibrary@gmail.com', 'SKPM library');
          $mail->addAddress($librarian_email);
          $mail->isHTML(true);
          $mail->Subject = 'Recovery Password';
          $mail->Body    = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p>
                            <p>Hello '.$librarian_fullname.'<br>
                            Your current password is <b>'.$recovery.'</b><br>
                            <p>More information please contact : +606-553 2499.</p>';
          $mail->AltBody = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p><
                            <p>Hello '.$librarian_fullname.'<br>
                            Your new password is <b>'.$recovery.'</b><br>
                            <p>More information please contact : +606-553 2499.</p>';
            $mail->send();

               echo "<script>alert('Successful recovery password. Please check your email!')
                       window.location.href='logout.php';</script>";
  }

  function recoveryAdmin(){

    include "db_conn.php";
    require 'php-mailer-master/PHPMailerAutoload.php';

    $email = Username();
    $recovery = generatePassword();

    $stmt5 = $conn->prepare("SELECT * FROM admin WHERE admin_email=?");
    $stmt5->bind_param("s", $email);
    $stmt5->execute();
    $result5 = $stmt5->get_result();
    $row5 = $result5->fetch_assoc();
       $admin_email = $row5 ['admin_email'];
       $admin_password = $row5 ['admin_password'];

       date_default_timezone_set('Asia/Kuala_Lumpur');
       $datetime = date("d F Y H:i");
       $generate = md5 ($recovery);
         $stmt8 = $conn->prepare("UPDATE admin SET admin_password = ? WHERE admin_email=?");
         $stmt8->bind_param("ss", $generate, $admin_email);
         $stmt8->execute();

           $mail = new PHPMailer;
           $mail->isSMTP();
           $mail->Host = 'smtp.gmail.com';
           $mail->SMTPAuth = true;
           $mail->Username = 'skpmlibrary@gmail.com';
           $mail->Password = 'skpm2018';
           $mail->SMTPSecure = false;
           $mail->Port = 587;
           $mail->setFrom('skpmlibrary@gmail.com', 'SKPM library');
           $mail->addAddress($admin_email);
           $mail->isHTML(true);
           $mail->Subject = 'Recovery Password';
           $mail->Body    = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p>
                             <p>Hello Admin<br>
                             Your current password is <b>'.$recovery.'</b><br>
                             <p>More information please contact : +606-553 2499.</p>';
           $mail->AltBody = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p><
                             <p>Hello Admin<br>
                             Your new password is <b>'.$recovery.'</b><br>
                             <p>More information please contact : +606-553 2499.</p>';
             $mail->send();

                echo "<script>alert('Successful recovery password. Please check your email!')
                        window.location.href='logout.php';</script>";
  }

  function recoveryMember(){

    include "db_conn.php";
    require 'php-mailer-master/PHPMailerAutoload.php';

    $email = Username();
    $recovery = generatePassword();

    $stmt6 = $conn->prepare("SELECT * FROM member WHERE member_email=?");
    $stmt6->bind_param("s", $email);
    $stmt6->execute();
    $result6 = $stmt6->get_result();
    $row6 = $result6->fetch_assoc();
      echo $member_fullname = $row6 ['member_fullname'];
      echo $member_email = $row6 ['member_email'];
      echo $member_password = $row6 ['member_password'];

      date_default_timezone_set('Asia/Kuala_Lumpur');
      $datetime = date("d F Y H:i");
      $generate = md5 ($recovery);
        $stmt9 = $conn->prepare("UPDATE member SET member_password = ? WHERE member_email=?");
        $stmt9->bind_param("ss", $generate, $member_email);
        $stmt9->execute();

          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'skpmlibrary@gmail.com';
          $mail->Password = 'skpm2018';
          $mail->SMTPSecure = false;
          $mail->Port = 587;
          $mail->setFrom('skpmlibrary@gmail.com', 'SKPM library');
          $mail->addAddress($member_email);
          $mail->isHTML(true);
          $mail->Subject = 'Recovery Password';
          $mail->Body    = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p>
                            <p>Hello '.$member_fullname.'<br>
                            Your current password is <b>'.$recovery.'</b><br>
                            <p>More information please contact : +606-553 2499.</p>';
          $mail->AltBody = '<p><h3>Congratulation!</h3><b>Successful recovery password on</b> '.$datetime.'</p>
                            <p>Hello '.$member_fullname.'<br>
                            Your new password is <b>'.$recovery.'</b><br>
                            <p>More information please contact : +606-553 2499.</p>';
            $mail->send();

               echo "<script>alert('Successful recovery password. Please check your email!')
                       window.location.href='logout.php';</script>";
  }


?>
