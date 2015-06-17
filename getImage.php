<?php
	header("Content-type: image/jpg");
	$id = $_GET['id'];
  	// do some validation here to ensure id is safe

  	$veza = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
    $veza->exec("set names utf8");
  	$result = $veza->query("SELECT slika FROM vijest WHERE id=$id");
  	
  	foreach ($result as $vijest) {
  		echo $vijest['slika'];
  	}

?>