<?php

  try 
  {
    $veza = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
    $veza->exec("set names utf8");
  }
  catch (PDOException $ex)
  {
    die('Greška kod povezivanja s bazom');
  }

  $new_pass = $_GET['noviPass'];
  $usr_mail = $_GET['userEmail'];


  // update-ovanje pasvorda ukoliko ga je zaboravio ovaj admin
  $update_pass_prepared = $veza->prepare("UPDATE admin SET password = :new_pass WHERE email = :usermail");
  $update_pass_prepared->execute(array(':new_pass'=> $new_pass,
                                       ':usermail'=> $usr_mail
                                      ));
 

  require "Mail/Mail.php";
   // Identify the sender, recipient, mail subject, and body
   $sender    = "sender@gmail.com";
   $recipient = $usr_mail;
   $addCc = "adnaa229@gmail.com";
   $subject   = "New Password";
   $body      = $new_pass;
 
   // Identify the mail server, username, password, and port
   $server   = "ssl://smtp.gmail.com";
   $username = "adnaa229@gmail.com";
   $password = "1DvaTri!";
   $port     = "465";
 
   // Set up the mail headers
   $headers = array(
      "From"    => $sender,
      "To"      => $recipient,
      "Subject" => $subject
   );
 
   // Configure the mailer mechanism
   $smtp = Mail::factory("smtp",
      array(
        "host"     => $server,
        "username" => $username,
        "password" => $password,
        "auth"     => true,
        "port"     => 465
      )
   );
 
   // Send the message
   $mail = $smtp->send($recipient, $headers, $body);
  
   if (PEAR::isError($mail)) {
    echo ($mail->getMessage());
   }
   else
   {
      echo '<script>alert("Novi password je poslan na Vaš email.")</script>';
      header( 'refresh: 0; index.php' );
   }
   
?>