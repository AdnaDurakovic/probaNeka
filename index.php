
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
                  echo "<a class='resetpass' href='reset_password.php'>Resetuj password?</a>";
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
    

    <div id= "tijelo">   
        <body onload="updateTime();">
            <div class="content">
                <img id="home-pic" src="slike/slika2.jpg" alt="Slika naslovnice">
                    <div class="article">
                        <?php
                            header('Content-Type: text/html; charset=utf-8');

                            $veza = new PDO("mysql:dbname=tut9;host=localhost;charset=utf8", "root", "root");
                            $veza->exec("set names utf8");
                             
                              $rezultat = $veza->query("SELECT id, naslov, autor, slika, tekst, UNIX_TIMESTAMP(datum) vrijeme, detaljno FROM vijest ORDER BY datum DESC");
                                if (!$rezultat) {
                                     $greska = $veza->errorInfo();
                                     print "SQL greška: " . $greska[2];
                                     exit();
                              }

                            foreach ($rezultat as $vijest) 
                            {
                                if($vijest['slika'] == null)
                                  $slika = '';
                                else
                                  $slika = '<img class = "article-pic" src="getImage.php?id='.$vijest['id'].'" alt="neka slika">';
                                  //  ako novost ima/nema detaljno
                                if($vijest['detaljno'] == null)
                                  $detaljno = '';
                                else
                                  $detaljno = '<a id="detaljnoTekst'.$vijest['id'].'" class="read-more" href="javascript:void(0)" onclick="showMore('.$vijest['id'].')">DETALJNIJE...</a>';

                                //  pokupi broj komentara
                                $sql = $veza->query("SELECT COUNT(*) FROM komentar WHERE vijest=".$vijest['id']);
                                $br_komentara = $sql->fetchColumn();

                                if($br_komentara[0] == 0)
                                {
                                    print '<div class="article"><h1>'.$vijest['naslov'].'</h1>
                                           <h2><strong>autor : </strong>'.$vijest['autor'].', <strong>Objavljeno : </strong>'.date("d.m.Y. (h:i)", $vijest['vrijeme']).'</h2>
                                           '.$slika.'<p>'.$vijest['tekst'].'<br><br>';
                                    echo '<div id="detaljnaVijest'.$vijest['id'].'"></div>';
                                    echo $detaljno;
                                    echo ' Nema komentara<br><br></p></div>';

                                    
                                }
                                else
                                {
                                   echo '<div class="article"><h1>'.$vijest['naslov'].'</h1>
                                       <h2><strong>autor : </strong>'.$vijest['autor'].', <strong>Objavljeno : </strong>'.date("d.m.Y. (h:i)", $vijest['vrijeme']).'</h2>
                                       '.$slika.'<p>'.$vijest['tekst'].'<br><br>';
                                   echo '<div id="detaljnaVijest'.$vijest['id'].'"></div>';
                                   echo $detaljno;
                                   echo '<a href = "javascript:void(0);" onclick="showDiv('.$vijest['id'].')">Ima '.$br_komentara[0].' komentara</a>';
                                   echo '<br><br></p></div>';
                                   echo '<div id="vijestBr'.$vijest['id'].'"></div>';    
                                }

                                
                                print   '<form action="index.php" method="post">
                                              <input type="hidden" id="pk" value="'.$vijest['id'].'">
                                              <input type="hidden" id="author" value="'.$autor.'">
                                              <br><textarea rows="5" cols="50" id="komm" placeholder="Komentar"></textarea><br>
                                              <input type="button" name="addcomm" value="Komentariši" onClick="sendComment(this.form)">
                                         </form>';  
                            }
                        ?>

                    </div>    
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
