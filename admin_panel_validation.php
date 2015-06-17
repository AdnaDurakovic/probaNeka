<?php
	header('Content-Type: text/html; charset=utf-8');

	try 
	{
		$veza = new PDO("mysql:dbname=tut9;host=localhost;charset=utf8", "root", "root");
		$veza->exec("set names utf8");
	}
	catch (PDOException $ex)
	{
		die('Greška kod povezivanja s bazom');
	}

	function testiraj_unos($data) 
    {
        $data = trim($data); // uklanja bespotrebne razmake i prazna polja
        $data = stripslashes($data); // uklanja backslahs-ove
        $data = htmlspecialchars($data); // sprečava XSS
        return $data;
    } 


	$prikaz = "";
	$username = $password = "";
	$username_err = $pass_err = "";
	$username_err_img = $pass_err_img = "";
	$usr_mail = $new_pass = "";

	header('Content-Type: text/html; charset=utf-8');
	if (isset($_POST["login"]))
	{
		$validno = true;

		if (empty($_POST["username"]) && empty($_POST["password"]))
		{
			$username_err = "Unesite username";
			$username_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
			$pass_err = "Unesite password";
			$pass_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
			$validno = false;
		}
		else if (empty($_POST["username"]) && !empty($_POST["password"])) 
		{
			$username_err = "Unesite username";
			$username_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
			$password = testiraj_unos($_POST["password"]);
			$validno = false;
		}
		else if (empty($_POST["password"]) && !empty($_POST["username"])) 
		{
			$pass_err = "Unesite password";
			$pass_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
			$username = testiraj_unos($_POST["usrname"]);
			$validno = false;
		}
		else
		{	
			$username = testiraj_unos($_POST["username"]);
			$password = testiraj_unos($_POST["password"]);

     		$rezultat_query = "SELECT password FROM admin WHERE username = :username";
     		$rezultat_prepared = $veza->prepare($rezultat_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
     		$rezultat_prepared->execute(array('username' => $username));
			$rezultat = $rezultat_prepared->fetch();
			
			/*
			echo '<script language="javascript">';
			echo 'alert("message successfully sent")';
			echo '</script>';
			*/
     			
	 		if ($rezultat == null) 
	 		{
          		$username_err = "Ne postoji korisnik s tim korisničkim imenom";
          		$username_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
          		$validno = false;
     		}
     		else
     		{
     			if ($password == $rezultat[0])
     			{
     				$validno = true;
     			}
     			else 
     			{
     				$pass_err = "Neispravan password";
					$pass_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
					$validno = false;

					$username = testiraj_unos($_POST["username"]);
					$korisnik_query = "SELECT email FROM admin WHERE username = :username";
		     		$korisnik_prepared = $veza->prepare($korisnik_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		     		$korisnik_prepared->execute(array('username' => $username));
					$korisnik_mail = $korisnik_prepared->fetch();

					$new_pass = randomPassword();
					$usr_mail = $korisnik_mail[0];

					
     			}
     				
     		}
		}

		if ($validno)
			header('Location: admin_login_OK_.php'); 
			//$prikaz = 'admin_login_OK.php';
		else
			$prikaz = 'admin_login_NOT_OK.php';

	}



	function randomPassword() 
	{
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $_pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $_pass[] = $alphabet[$n];
	    }
	    return implode($_pass); //turn the array into a string
	}

?>