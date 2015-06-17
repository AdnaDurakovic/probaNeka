<!--     PHP       -->
<?php

    header('Content-Type: text/html; charset=utf-8');
    
        // Inicijalizacija varijabli
        $firstname = $email = $emailpotvrda = $poruka = $mjesto = $ptbroj = $predmet = "";
        $firstname_err = $email_err = $emailpotvrda_err = $poruka_err = "* ";
        $mjesto_err = $ptbroj_err = "";
        $slika_firstname = $slika_email = $slika_poruka = $slika_mjesto = $slika_ptbroj = $slika_emailpotvrda = "";
        $show_form = "";

        // Validacija obaveznih polja   
        //if ($_SERVER["REQUEST_METHOD"] == "POST") 
        if (isset($_POST["send"]))
        {
            
            $validno = true;

            if (empty($_POST["firstname"])) 
            {
                $firstname_err = "Unesite ime i prezime";
                $slika_firstname = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
                $firstname = testiraj_unos($_POST["firstname"]);
                // provjera da li je ime ispravno uneseno
                if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) 
                {
                    $firstname_err = "Samo slova i razmaci su dozvoljeni"; 
                    $slika_firstname = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }
           
            if (empty($_POST["email"])) 
            {
                $email_err = "Unesite Email";
                $slika_email = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
                $email = testiraj_unos($_POST["email"]);
                // provjerava je li unesen ispravan format emaila
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $email_err = "Neispravan format emaila"; 
                    $slika_email = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }

                // provjera potvrdnog emaila
                if (empty($_POST["emailpotvrda"]))
                {
                    $emailpotvrda_err = "Unesite potvrdni Email";
                    $slika_emailpotvrda = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
                else
                {
                    $emailpotvrda = testiraj_unos($_POST["emailpotvrda"]);
                    // provjerava je li unesen ispravan format emaila
                    if (!filter_var($emailpotvrda, FILTER_VALIDATE_EMAIL)) 
                    {
                        $emailpotvrda_err = "Neispravan format emaila"; 
                        $slika_emailpotvrda = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                        $validno = false;
                    }
                    else
                    {
                        //cross validacija
                        if ($email != $emailpotvrda) 
                        {
                            $emailpotvrda_err = "Nisu isti orginalni i potvrdni email"; 
                            $slika_emailpotvrda = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                            $validno = false;
                        } 
                    }
                        
                }
            }


            if (empty($_POST["myname"])) 
            {
                $poruka_err = "Napišite poruku";
                $slika_poruka = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
                $poruka = testiraj_unos($_POST["myname"]);
            }


            if (!empty($_POST["mjesto"])) 
            {
                $mjesto = testiraj_unos($_POST["mjesto"]);
                // provjera da li je mjesto ispravno uneseno
                if (!preg_match("/^[a-zA-Z ]*$/",$mjesto)) 
                {
                    $mjesto_err = "Samo slova i razmaci su dozvoljeni"; 
                    $slika_mjesto = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }

            if (!empty($_POST["ptbroj"])) 
            {
                $ptbroj = testiraj_unos($_POST["ptbroj"]);
                // provjera da li je ime ispravno uneseno
                if (!is_numeric($ptbroj)) 
                {
                    $ptbroj_err = "Samo brojevi su dozvoljeni"; 
                    $slika_ptbroj = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }

            if(!empty($_POST["predmet"]))
            {
                $predmet = testiraj_unos($_POST["predmet"]);
            }
        }

        if (isset($_POST["reset"]))
        {
            $firstname = $email = $emailpotvrda = $poruka = $mjesto = $ptbroj = $predmet = "";
        }


        function testiraj_unos($data) 
        {
           $data = trim($data); // uklanja bespotrebne razmake i prazna polja
           $data = stripslashes($data); // uklanja backslahs-ove
           $data = htmlspecialchars($data); // sprečava XSS
           return $data;
        } 

        //if valid then redirect
        if($validno)
        {
            $show_form='Form_OK.php';
        }  
        else
        {
            $show_form='Form_NOT_OK.php';
        }     
?>