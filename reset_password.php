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

<div id = "tijelo">
    <body>   
        <div class="content">  
               

                <?php
                    if(isset($_POST["resetPass"]))  
                    {
                      $poruka_greske = $username_err_img = "";
                      try 
                      {
                        $veza = new PDO("mysql:dbname=tut9;host=localhost;charset=utf8", "root", "root");
                        $veza->exec("set names utf8");
                      }
                      catch (PDOException $ex)
                      {
                        die('Greška kod povezivanja s bazom');
                      }

                      $username = testiraj_unos($_POST["noviPassusr"]);
                      $korisnik_query = "SELECT email FROM admin WHERE username = :username";
                      $korisnik_prepared = $veza->prepare($korisnik_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                      $korisnik_prepared->execute(array('username' => $username));
                      $korisnik_mail = $korisnik_prepared->fetch();

                      
                      if ($korisnik_mail == null) 
                      {
                        $poruka_greske = "Nepostojeći korisnik";
                        $username_err_img = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                      }
                      else 
                      {
                        $token = randomToken();
                        $usr_mail = $korisnik_mail[0];
                        include 'send_token.php';
                      }

                      
                    }

                    function randomToken() {
                        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                        $token = array(); 
                        $alphaLength = strlen($alphabet) - 1;
                        for ($i = 0; $i < 15; $i++) {
                            $n = rand(0, $alphaLength);
                            $token[] = $alphabet[$n];
                        }
                        return implode($token); 
                    }


                    function testiraj_unos($data) 
                    {
                      $data = trim($data); // uklanja bespotrebne razmake i prazna polja
                      $data = stripslashes($data); // uklanja backslahs-ove
                      $data = htmlspecialchars($data); // sprečava XSS
                      return $data;
                    }
                ?>    

                <div id="resetpassword">
                  <form action="reset_password.php" method="post">
                    <input type="text" name="noviPassusr" placeholder="Username"><br><br>
                    <input type="text" name="noviPass" placeholder="Novi password"><br><br>
                    <input type="submit" name="resetPass" id="resetPass" value="Reset">
                  </form>
                  <br><br>
                  <label class="error_token"><?php echo $username_err_img;?>&nbsp;&nbsp;<?php echo $poruka_greske; ?></label>
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