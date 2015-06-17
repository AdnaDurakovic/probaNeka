<div class = "required">* Obavezna polja</div>
<br>
<br>

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

