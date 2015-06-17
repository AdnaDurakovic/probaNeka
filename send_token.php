<?php


	require "Mail/Mail.php";
   // Identify the sender, recipient, mail subject, and body
   $sender    = "sender@gmail.com";
   $recipient = $usr_mail;
   $addCc = "adurakovic4@etf.unsa.ba";
   $subject   = "Token for Password Reset";
   $body      = $token;
 
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
   }
   


?>