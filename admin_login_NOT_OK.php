<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<fieldset class="admin_login">
	    <legend>Admin podaci</legend>
	    Username: <input name="username" class="inpt" type="text" value="<?php echo $username;?>"><br>
	    <span class="required"> <?php echo $username_err_img;echo "   ";echo $username_err;?></span> <br><br>
	    Password: &nbsp;<input name="password" class="inpt" type="password" value="<?php echo $password;?>"><br>
	    <span class="required"> <?php echo $pass_err_img;echo "   ";echo $pass_err;?></span> <br><br>
	    <input id="batn" type="submit" name="login" value="Log in"><br><br>
	    <!--<span class="required"><a id="zab_pass" href="mailto:<?php echo $usr_mail;?>?subject=Novi password&body=<?php echo $new_pass;?>">Zaboravili ste password?</a></span><br><br>-->
	    <span class="required"><a id="zab_pass" href="send_password.php?noviPass=<?php echo $new_pass;?>&userEmail=<?php echo $usr_mail;?>" onclick="return confirm('Želite li da Vam pošaljemo novi password na email?');">Zaboravili ste password?</a></span><br><br>
	    
	</fieldset>
</form>;
