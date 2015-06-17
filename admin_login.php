<div id = "tijelo">
    <body>   
        <div class="content">  
               
                <?php
                    header('Content-Type: text/html; charset=utf-8');
                    echo '<div id="adminpanelopen">
                          <form><input type="submit" name="openpanel" value="Otvori admin panel">
                          </form><br><br>
                          <div id="resetpassword">
                          <form>
                          <br><br>
                          <input type="text" name="noviPass" placeholder="Novi password"><br><br> 
                          <input id="resetPass" type="submit" value="Resetuj password" onclick="resetujPassword(this.form)">
                          </form></div>
                          <br><br>
                          </div>';

                    if(isset($_POST["openpanel"]))  
                    {
                      include 'admin_panel.php';
                    }
                ?>    



        </div>
    </body>
</div>