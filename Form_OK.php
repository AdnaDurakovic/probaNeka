
<fieldset>
    <h3>Provjerite da li ste ispravno popunili kontakt formu:</h3>
    <br>
    <?php print "Ime i prezime: " .$firstname ?>
    <br><br>
    <?php print "Grad: " .$mjesto ?>
    <br><br>
    <?php print "Poštanski broj: " .$ptbroj ?>
    <br><br>
    <?php print "Email: " .$email ?>
    <br><br>
    <?php print "Predmet: " .$predmet ?>
    <br><br>
    <?php print "Poruka: " .$poruka ?>
    <br><br>

    <h3>Da li ste sigurni da želite poslati ove podatke?</h3>
    <form method="post" name = "sendemail" action="send_email.php">
        <input type="submit" name="send_email" value="Siguran sam">
        <input type="hidden" name="firstname" value="<?php echo $firstname;?>">
        <input type="hidden" name="email" value="<?php echo $email;?>">
        <input type="hidden" name="myname" value="<?php echo $poruka;?>">
    </form>
</fieldset>    



<br><br><br>
<h3>Ako ste pogrešno popunili formu, možete ispod prepraviti <br>unesene podatke: </h3>



<form name = "formica" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <p id = "ime">Ime i prezime:
        <br> 
        <input type="text" name="firstname" value="<?php echo $firstname;?>"> 
        <span class="required"> <?php echo $slika_firstname;echo "   ";echo $firstname_err;?></span>              
    </p>

    <p id = "grad">Grad:
        <br>
        <input type="text" name="mjesto" value="<?php echo $mjesto;?>">
        <span class="required"> <?php echo $slika_mjesto;echo "   ";echo $mjesto_err;?></span>
    </p>

    <p id = "ptbroj">Poštanski broj:
        <br>
        <input type="text" name="ptbroj" value="<?php echo $ptbroj;?>">
        <span class="required"> <?php echo $slika_ptbroj;echo "   ";echo $ptbroj_err;?></span>
    </p>
                    
    <p id = "email">Email:
        <br>
        <input type="text" name="email" value="<?php echo $email;?>">
        <span class="required"> <?php echo $slika_email;echo "   ";echo $email_err;?></span>      
    </p>

    <p id = "emailpotvrda">Potvrdi Email:
        <br>
        <input type="text" name="emailpotvrda" value="<?php echo $emailpotvrda;?>">
        <span class="required"> <?php echo $slika_emailpotvrda;echo "   ";echo $emailpotvrda_err;?></span>
    </p>
                    
    <p id = "predmet">Predmet:
        <br>
        <input type="text" name="predmet" value="<?php echo $predmet;?>">
    </p>
                    
    <p id = "poruka">Poruka:
        <br>
        <textarea rows="10" cols="50" name="myname"><?php echo $poruka;?></textarea>
        <span class="required"> <?php echo $slika_poruka;echo "   ";echo $poruka_err;?></span>       
    </p>

    <p id = "button-submit">
        <button name="send" type="submit" value="Submit">Pošalji</button>
    </p>

    <p id= "button-reset">
        <button name="reset" type="reset" value="Reset">Resetuj</button>
    </p>
</form>


