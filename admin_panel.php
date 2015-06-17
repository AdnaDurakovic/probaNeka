<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Željeznice | SoulTrain</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
        <script src="funkcije.js"></script>
    </head>

    <div class="menu">
        <a class="logo" href="#" onClick = "funkcijaHome()"><img src="slike/logo.png" alt="Logo">SoulTrain</a>        

          <ul>

            <?php
              session_start();

              if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
                // last request was more than 30 minutes ago
                session_unset();     // unset $_SESSION variable for the run-time 
                session_destroy();   // destroy session data in storage
                echo "<label class='crvena'>Sesija je istekla!</label>";
              }
              $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

              if (isset($_SESSION['username'])) 
                $username = $_SESSION['username'];
              else if (isset($_REQUEST['username'])) 
              {
                $username = $_REQUEST['username'];
                $pass = $_REQUEST['password'];
                $username = htmlentities($username);
                $pass = htmlentities($pass);
                        
                $veza = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
                $veza->exec("set names utf8");
                        
                $sql = "SELECT * FROM admin WHERE username=:user AND password=:pass";
                $q = $veza->prepare($sql);
                $q->execute(array(':user'=>$username, ':pass'=>$pass));
                if($q->rowCount()==1)
                {
                  $_SESSION['username'] = $username;
                  $_SESSION['isadmin'] = $q->fetchColumn(4);
                }
                else
                {
                  unset($username);
                  echo "<label class='crvena'>Pogrešan username ili password</label>";
                }

              }
            ?>
          <li><a href="#" onClick = "funkcijaHome()">NASLOVNA</a></li>
          <li><a href="#" onClick = "funkcijaRoutes()">VOZNI RED</a></li>
          <li><a href="#" onClick = "funkcijaContact()">KONTAKT</a></li>
          <li><a href="#" onClick = "funkcijaAbout()">O NAMA</a></li>

          <?php
          if(isset($_REQUEST['logout']))
          {
            session_destroy();
            unset($username);
          }
          if(isset($username) and $username!="")
          {
            $autor = $username;
            
            echo "<div id='loggedin'>"
                . "<form method='POST' action='index.php'><label>Ulogovani ste kao: <strong class='zelena'>$username</strong></label>&nbsp;&nbsp;"
                    . "<input type='submit' id='login_button' name='logout' value='Log Out'>"
                . "</form></div>";

            
            if ($_SESSION['isadmin'] == 1)
              echo '<li id="adminpanel"><a href="#" onClick = "funkcijaAdminPanel()">ADMIN</a><li>';

          }
          else
          {
              $autor = "Anonimac";
              echo '<div id="login">
                      <form action="index.php" method="post">
                        <input id="user_name" name="username" type="text" placeholder="Username">
                        <input id="user_pass" name="password" type="text" placeholder="Password">
                        <input type="submit" id="login_button" name="userlogin" value="Log In">
                      </form>
                    </div>';
          }

        ?>
   
        </ul>


    </div>

<div id = "tijelo">
    <body>   
        <div class="content">  
               
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
                                        <form id="formica" action="admin_panel.php" method="post">
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
                                                <form id="formica" action="admin_panel.php" method="post">
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

                        header('Location: admin_panel.php'); // očisti POST*/
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

                        header('Location: admin_panel.php.php'); // očisti POST
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

                        header('Location: admin_panel.php'); // očisti POST
                    }

                    // KOMENTARI
                    foreach ($svi_komentari_query as $komentar) {
                        $_komentar = '<div id="kom">
                                        <strong>'.$komentar['autor'].'</strong><br>
                                        <small id="kom_datum">'.$komentar['datum'].'</small><br><br>
                                        <small>'.$komentar['tekst'].'</small><br><br>    
                                    </div><br>
                                    <form action="admin_panel.php" method="post">
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

                        header('Location: admin_panel.php'); // očisti POST
                    }

                    // KORISNICI
                    foreach ($svi_korisnici_query as $admin) {
                        $_korisnik = '<div id="kom">
                                        <strong> Username: '.$admin['username'].'</strong><br>
                                        <strong>Password: '.$admin['password'].'</strong><br><br>
                                        <small>Email: '.$admin['email'].'</small><br><br>    
                                    
                                    <form action="admin_panel.php" method="post">
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
                                                <form action="admin_panel.php" method="post">
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

                        header('Location: admin_panel.php'); // očisti POST
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

                        header('Location: admin_panel.php'); // očisti POST
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
                            header('Location: admin_panel.php'); // očisti POST*/
                        }


                        
                    }


                    // ISPIS
                    echo '<div>
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
            ?>

        </div>
    </body>
</div>

<!--U footeru se nalaze linkovi u vidu neuređene liste-->
    <div class="footer">  
        <p id="copyright">© 2023 by AdnaDurakovic</p>
        <ul id="links">
            <li><a href="https://www.facebook.com/"><img src="slike/facebook.png" height="30px" width="30px" alt="Facebook"></a></li>
            <li><a href="https://www.twitter.com/"><img src="slike/twitter.png" height="30px" width="30px" alt="Twitter"></a></li>
            <li><a href="https://www.instagram.com/"><img src="slike/instagram.png" height="30px" width="30px" alt="Instagram"></a></li>
        </ul>
    </div>

</html>

<!-- kraj HTMLa -->