<?php
	header('Content-Type: text/html; charset=utf-8');

  	$name = $_POST['firstname'];
  	$visitor_email = $_POST['email'];
  	$message = $_POST['myname'];

    require "Mail/Mail.php";
    // Identify the sender, recipient, mail subject, and body
    $sender    = $visitor_email;
    $recipient = "adurakovic4@etf.unsa.ba";
    $addCc = "adnaa229@gmail.com";
    $subject   = "Submitovana forma - Zeljeznice SoulTrain";
    $body      = $message;
 
    // Identify the mail server, username, password, and port
    $server   = "ssl://smtp.gmail.com";
    $username = "adnaa229@gmail.com";
    $password = "1DvaTri!";
    $port     = "465";
 
    // Set up the mail headers
    $headers = array(
      "From"    => $sender,
      "To"      => $recipient,
      "Cc"      => $addCc,
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
      echo '<script>alert("Zahvaljujemo se što ste nas kontaktirali.")</script>';
      header( 'refresh: 0; index.php' );
    }

?>