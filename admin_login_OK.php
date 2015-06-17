<?php
	header('Content-Type: text/html; charset=utf-8');
	$bla = "";
	try 
	{
		$veza = new PDO("mysql:dbname=tut9;host=localhost;charset=utf8", "root", "root");
		$veza->exec("set names utf8");
	}
	catch (PDOException $ex)
	{
		die('Greška kod povezivanja s bazom');
	}

	function testiraj_unos($podaci) 
    {
        $podaci = trim($podaci); // uklanja bespotrebne razmake i prazna polja
        $podaci = stripslashes($podaci); // uklanja backslahs-ove
        $podaci = htmlspecialchars($podaci); // sprečava XSS
        return $podaci;
    } 


	// VIJESTI
	$sve_vijesti_query = $veza->query("SELECT * FROM vijest ORDER BY datum DESC");
	$svi_komentari_query = $veza->query("SELECT * FROM komentar ORDER BY datum DESC");
	$svi_korisnici_query = $veza->query("SELECT * FROM admin ORDER BY id DESC");

	$sve_vijesti = $svi_komentari = $svi_korisnici = array();

	foreach ($sve_vijesti_query as $vijest) {
		$_vijest = 
		$_vijest = '<div id="kom">
		      			<strong>'.$vijest['naslov'].'</strong><br>
			    		<small id="kom_datum">'.$vijest['datum'].'</small><br>
			    		<small id="kom_datum">'.$vijest['autor'].'</small><br><br>
			    		<img class = "article-pic" src="getImage.php?id='.$vijest['id'].'" alt="nema slike"><br>
			      		<small>'.$vijest['tekst'].'</small><br> 
			      		<small>'.$vijest['detaljno'].'</small><br><br>  
			      		<form id="formica" action="admin_login_OK_.php" method="post">
			      			<input type="hidden" name="pk" value="'.$vijest['id'].'">
			      			<button id="batnObrisi" type="submit" name="buttonObrisiVijest">Obriši</button><br><br>
	       					<input type="text" name="aut" placeholder="Autor">
	       					<input type="text" name="nasl" placeholder="Naslov"><br><br>
	       					<textarea rows="5" cols="50" name="txt" placeholder="Vijest"></textarea><br>
	       					<textarea rows="5" cols="50" name="det" placeholder="Detaljno"></textarea><br>
	       					<button id="batnDodajIzmijeni" type="submit" name="buttonIzmijeniVijest">Izmijeni</button><br><br>
	       				</form>  
	       			</div>
	       			<br>';

	    array_push($sve_vijesti, $_vijest);

	}

	$forma_za_dodavanje_vijesti = '<div id="kom">
	    						<strong>Dodaj novu vijest</strong><br><br>
			      				<form id="formica" action="admin_login_OK_.php" method="post">
			      					<input type="hidden" name="pk" value="'.$vijest['id'].'">
	       							<input type="text" name="aut" placeholder="Autor">
	       							<input type="text" name="nasl" placeholder="Naslov"><br><br>
	       							<textarea rows="5" cols="50" name="txt" placeholder="Vijest"></textarea><br>
	       							<textarea rows="5" cols="50" name="det" placeholder="Detaljno"></textarea><br>
	       							<button id="batnDodajIzmijeni" type="submit" name="buttonDodajVijest">Dodaj</button><br><br>
	       						</form>  
	       					</div>
	       					<br>';

	array_push($sve_vijesti, $forma_za_dodavanje_vijesti);


	if(isset($_POST['buttonObrisiVijest']))
	{
		$pk = $_POST['pk'];

		$rez = $veza->prepare("DELETE FROM vijest WHERE id = :pk");
	    $rez->execute(array(':pk' => $pk));

	    header('Location: admin_login_OK_.php'); // očisti POST*/
	}

	if(isset( $_POST['buttonIzmijeniVijest']))
	{
		$pk = $_POST['pk'];
		$autor = testiraj_unos($_POST['aut']);
		$naslov = testiraj_unos($_POST['nasl']);
		$txt = testiraj_unos($_POST['txt']);
		$detaljnije = testiraj_unos($_POST['det']);

		$rez = $veza->prepare("UPDATE vijest SET autor=:aut, naslov=:naslov, tekst=:txt, detaljno=:detalji WHERE id = :pk");
	    $rez->execute(array(':pk' => $pk,
	    					':aut' => $autor,
	    					':naslov' => $naslov,
	    					':txt' => $txt,
	    					':detalji' => $detaljnije,
	    					));

	    header('Location: admin_login_OK_.php'); // očisti POST
	}

	if(isset( $_POST['buttonDodajVijest']))
	{
		$pk = $_POST['pk'];
		$autor = testiraj_unos($_POST['aut']);
		$naslov = testiraj_unos($_POST['nasl']);
		$txt = testiraj_unos($_POST['txt']);
		$detaljnije = testiraj_unos($_POST['det']);
		$slika = $_POST['fileToUpload'];

		$rez = $veza->prepare("INSERT INTO vijest(autor, naslov, tekst, detaljno) VALUES (:aut, :naslov, :txt, :detalji)");
	    $rez->execute(array(':aut' => $autor,
	    					':naslov' => $naslov,
	    					':txt' => $txt,
	    					':detalji' => $detaljnije,
	    					));

	    header('Location: admin_login_OK_.php'); // očisti POST
	}

	// KOMENTARI
	foreach ($svi_komentari_query as $komentar) {
		$_komentar = '<div id="kom">
		      			<strong>'.$komentar['autor'].'</strong><br>
			    		<small id="kom_datum">'.$komentar['datum'].'</small><br><br>
			      		<small>'.$komentar['tekst'].'</small><br><br>    
	       			</div><br>
	       			<form action="admin_login_OK_.php" method="post">
	       				<input type="hidden" name="pk" value="'.$komentar['id'].'">
	       				<button id="batnObrisi" type="submit" name="buttonObrisiKom">Obriši</button>
	       			</form>
	       			<br><br>';

	    array_push($svi_komentari, $_komentar);
	}

	if(isset( $_POST['buttonObrisiKom']))
	{
		/*
		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
		*/

		$pk = $_POST['pk'];

		$rez = $veza->prepare("DELETE FROM komentar WHERE id = :pk");
	    $rez->execute(array(':pk' => $pk));

	    header('Location: admin_login_OK_.php'); // očisti POST
	}

	// KORISNICI
	foreach ($svi_korisnici_query as $admin) {
		$_korisnik = '<div id="kom">
		      			<strong> Username: '.$admin['username'].'</strong><br>
			    		<strong>Password: '.$admin['password'].'</strong><br><br>
			      		<small>Email: '.$admin['email'].'</small><br><br>    
	       			
	       			<form action="admin_login_OK_.php" method="post">
	       				<input type="hidden" name="pk" value="'.$admin['id'].'">
	       				<button id="batnObrisi" type="submit" name="buttonObrisiKor">Obriši</button><br>
	       				<input type="text" name="usr" placeholder="Username"><br><br>
	       				<input type="text" name="eml" placeholder="Email"><br><br>
	       				<input type="text" name="pas" placeholder="Password"><br><br>
	       				<button id="batnDodajIzmijeni" type="submit" name="buttonIzmijeniKor">Izmijeni</button><br><br>
	       			</form>
	       			</div>
	       			<br>';

	    array_push($svi_korisnici, $_korisnik);
	}

	$forma_za_dodavanje_kor = '<div id="kom">
								<strong>Dodajte novog korisnika</strong><br><br>
	       						<form action="admin_login_OK_.php" method="post">
	       							<input type="hidden" name="pk" value="'.$admin['id'].'">
				       				<input type="text" name="usr" placeholder="Username"><br><br>
				       				<input type="text" name="eml" placeholder="Email"><br><br>
				       				<input type="text" name="pas" placeholder="Password"><br><br>
				       				<button id="batnDodajIzmijeni" type="submit" name="buttonDodajKor">Dodaj</button><br>
				       			</form>
				       			<br>';

	array_push($svi_korisnici, $forma_za_dodavanje_kor);

	if(isset( $_POST['buttonDodajKor']))
	{
		$pk = $_POST['pk'];
		$user = testiraj_unos($_POST['usr']);
		$pass = testiraj_unos($_POST['pas']);
		$usr_mail = testiraj_unos($_POST['eml']);

		$rez = $veza->prepare("INSERT INTO admin(username, password, email) VALUES (:user, :pass, :mail)");
	    $rez->execute(array(':user' => $user,
	    					':pass' => $pass,
	    					':mail' => $usr_mail
	    					));

	    header('Location: admin_login_OK_.php'); // očisti POST
	}

	if(isset( $_POST['buttonIzmijeniKor']))
	{
		$pk = $_POST['pk'];
		$user = testiraj_unos($_POST['usr']);
		$pass = testiraj_unos($_POST['pas']);
		$usr_mail = testiraj_unos($_POST['eml']);

		$rez = $veza->prepare("UPDATE admin SET username = :user, password = :pass, email = :mail WHERE id = :pk");
	    $rez->execute(array(':pk' => $pk,
	    					':user' => $user,
	    					':pass' => $pass,
	    					':mail' => $usr_mail
	    					));

	    header('Location: admin_login_OK_.php'); // očisti POST
	}

	if(isset($_POST['buttonObrisiKor']))
	{
		$pk = $_POST['pk'];
		
		$izbroji = $veza->query("SELECT COUNT(id) FROM admin");
		$broj_admina = $izbroji->fetchColumn();

		if($broj_admina[0] == 1)
		{
			echo '<script language="javascript">';
			echo 'alert("Mora ostati barem jedan korisnik u bazi!")';
			echo '</script>';
		}
		else
		{
			$rez = $veza->prepare("DELETE FROM admin WHERE id = :pk");
	    	$rez->execute(array(':pk' => $pk));
	    	header('Location: admin_login_OK_.php'); // očisti POST*/
		}


	    
	}


	// ISPIS
	$bb ='<div>
			<fieldset id="komentar_fs">
				<legend>Komentari</legend>
				'.implode('',$svi_komentari).'
			</fieldset><br><br>

			<fieldset id="korisnici_fs">
				<legend>Korisnici</legend>
				'.implode('',$svi_korisnici).'
			</fieldset><br><br>

			<fieldset id="novosti_fs">
				<legend>Novosti</legend>
				'.implode('',$sve_vijesti).'
			</fieldset>
		</div>';

 $bla=$bb;

?>