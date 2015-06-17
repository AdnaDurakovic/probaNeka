<?php
	header('Content-Type: text/html; charset=utf-8');

	$veza = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
  $veza->exec("set names utf8");
     
  $rezultat = $veza->query("SELECT id, naslov, autor, slika, tekst, UNIX_TIMESTAMP(datum) vrijeme, detaljno FROM vijest ORDER BY datum DESC");
	if (!$rezultat) {
         $greska = $veza->errorInfo();
         print "SQL greška: " . $greska[2];
         exit();
  }
	
  $novost = array();
	//$komentari = array();

  foreach ($rezultat as $vijest) 
  {
   	//  pokupi broj komentara
  	$sql = $veza->query("SELECT COUNT(*) FROM komentar WHERE vijest=".$vijest['id']);
  	$br_komentara = $sql->fetchColumn();

    if($br_komentara[0] == 0)
      {
        $broj_komentara = "Nema komentara.";
      }
      else
      {
        $broj_komentara = '<a class="comment" href = "javascript:void(0)" onclick="showDiv('.$vijest['id'].')">Ima '.$br_komentara[0].' komentara.</a><br><br>';
        echo '<div id="vijestBr'.$vijest['id'].'"></div>';
        
      }

      $forma = '
                <form class="komentar_forma" action="index.php" method="post" onSubmit="sendComment(this)">
                  <input type="hidden" id="date" value="'.date("Y-m-d H:i:s").'">
                  <input type="hidden" id="pk" value="'.$vijest['id'].'">
                  <br><input type="text" id="author" placeholder="Ime i prezime"><br>
                  <br><input type="text" id="mail" placeholder="E-mail (opcionalno)"><br>
                  <br><textarea rows="5" cols="50" id="kom" placeholder="Komentar"></textarea><br>
                  <input type="submit" name="addcomm" value="Komentariši">
                </form>
              ';

    if($vijest['slika'] == null)
      $slika = '';
    else
      $slika = '<img class = "article-pic" src="getImage.php?id='.$vijest['id'].'" alt="neka slika">';
      //  ako novost ima/nema detaljno
    if($vijest['detaljno'] == null)
      $detaljno = '';
    else
      $detaljno = '<a class="read-more" href="?vijestBr='.$vijest['id'].'">DETALJNIJE...</a>';
      
    $jedna_novost = '<div class="article"><h1>'.$vijest['naslov'].'</h1>
                    <h2><strong>autor : </strong>'.$vijest['autor'].', <strong>Objavljeno : </strong>'.date("d.m.Y. (h:i)", $vijest['vrijeme']).'</h2>
                    '.$slika.'<p>'.$vijest['tekst'].'<br><br>'.$detaljno.''.$broj_komentara.'</p></div>';

    array_push($novost, $jedna_novost );
    array_push($novost, $forma);
  	
    /*
    if($br_komentara[0] == 0)
  		$broj_komentara = '<a class="comment" onclick="showDiv('.$vijest['id'].')" href="#?vid='.$vijest['id'].'">Nema komentara</a>';
  	else
  		$broj_komentara = '<a class="comment" onclick="showDiv('.$vijest['id'].')" href="#?vid='.$vijest['id'].'">Ima '.$br_komentara.' komentara</a>';
   	//  ako novost ima/nema sliku
   	if($vijest['slika'] == null)
  		$slika = '';
  	else
  		$slika = '<img class = "article-pic" src="getImage.php?id='.$vijest['id'].'" alt="neka slika">';
    	//  ako novost ima/nema detaljno
  	if($vijest['detaljno'] == null)
  		$detaljno = '';
  	else
  		$detaljno = '<a class="read-more" href="?vijestBr='.$vijest['id'].'">DETALJNIJE...</a>';
    	$jedna_novost = '<div class="article"><h1>'.$vijest['naslov'].'</h1>
                  		<h2><strong>autor : </strong>'.$vijest['autor'].', <strong>Objavljeno : </strong>'.date("d.m.Y. (h:i)", $vijest['vrijeme']).'</h2>
                  		'.$slika.'<p>'.$vijest['tekst'].'<br><br>'.$detaljno.''.$broj_komentara.'</p></div>';
        


          

    $sql = $veza->query("SELECT * FROM komentar WHERE vijest=".$vijest['id']." ORDER BY datum DESC");

    if ($br_komentara != 0)
      array_push($komentari, '<div class="comments"><h3>Komentari</h3></div>');

	  foreach ($sql as $komentar) 
	  {
	   	if ($komentar['email'] == null)
	   		$email = '"#"';
	   	else
	   		$email = '"mailto:'.$komentar['email'].'"';

	   	$jedan_komentar = '<div class="comments">
	 	      				        <p id="kom">
		      				        <strong><a href='.$email.'>'.$komentar['autor'].'</a></strong><br>
			    				        <small id="kom_datum">'.$komentar['datum'].'</small><br><br>
			      				      <small>'.$komentar['tekst'].'</small>
		      				        </p>
	       				         </div>';
	       	array_push($komentari, $jedan_komentar);
	    }

	    $forma = '<div id = "komDiv'.$vijest['id'].'" class = "komentar_forma">
        			<form action="index.php" method="post">
        				<input type="hidden" name="date" value="'.date("Y-m-d H:i:s").'">
        				<input type="hidden" name="pk" value="'.$vijest['id'].'">
                		<br><input type="text" name="aut" placeholder="Ime i prezime"><br>
                		<br><input type="text" name="mail" placeholder="E-mail (opcionalno)"><br>
                		<br><textarea rows="5" cols="50" name="kom" placeholder="Komentar"></textarea><br>
                		<input type="submit" name="Submit1" value="Komentariši">
              	  	</form>
              	  </div>';


        array_push($novost, $jedna_novost );
        array_push($novost, $forma);
        $komentari = array();
        */
    }

   
/*
    // ako je neko kliknuo "Detaljnije..."
	if(isset($_GET['vijestBr'])) 
	{
		$novost = array();
		$vijest_sql =  $veza->query("SELECT * FROM vijest WHERE id=".$_GET['vijestBr']);
		foreach ($vijest_sql as $vijest) 
   		{
   			$slika = '<img class = "article-pic" src="getImage.php?id='.$vijest['id'].'" alt="neka slika">';
   			
   			$jedna_novost = '<div class="article"><h1>'.$vijest['naslov'].'</h1>
                 			<h2><strong>autor : </strong>'.$vijest['autor'].', <strong>Objavljeno : </strong>'.date("d.m.Y. (h:i)", $vijest['vrijeme']).'</h2>
                 		   	'.$slika.'<p>'.$vijest['tekst'].'<br>'.$vijest['detaljno'].'</p><br></div>';

            array_push($novost, $jedna_novost );
   		}
	}
*/
	function testiraj_unos($podaci) 
  {
      $podaci = trim($podaci); // uklanja bespotrebne razmake i prazna polja
      $podaci = stripslashes($podaci); // uklanja backslahs-ove
      $podaci = htmlspecialchars($podaci); // sprečava XSS
      return $podaci;
  } 

  $autor = $email = $komentar_tekst = $datum = "";

/*
	if(isset( $_POST['addcomm']))
	{
		$autor = testiraj_unos($_POST['author']);
		$email = testiraj_unos($_POST['mail']);
		$komentar_tekst = testiraj_unos($_POST['kom']);
    $pk = $_POST['pk'];

	  $rez = $veza->prepare("INSERT INTO komentar (autor, tekst, email, vijest) VALUES (:autor, :komentar_tekst, :email, :pk)");
	  $rez->execute(array(':autor'=>$autor,
                        ':komentar_tekst'=>$komentar_tekst,
                        ':email'=>$email,
                        ':pk'=>$pk));

	  if (!$rez) 
    {
	  	$greska = $veza->errorInfo();
	    echo '<script language="javascript">';
		  echo 'alert("'.$greska[2].'")';
			echo '</script>';
      exit();
    }

     	header('Location: index.php'); // očisti POST
	}
  */

?>

