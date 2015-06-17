<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) { }
function rest_post($request, $data) 
{
    // Inicijalizacija varijabli
        $firstname = htmlentities($data['firstname']);
        $email = htmlentities($data['email']);
        $emailpotvrda = htmlentities($data['emailpotvrda']);
        $poruka = htmlentities($data['poruka']);
        $mjesto = htmlentities($data['mjesto']);
        $ptbroj = htmlentities($data['ptbroj']);
        $predmet = htmlentities($data['predmet']);


        $firstname_err = $email_err = $emailpotvrda_err = $poruka_err = "* ";
        $mjesto_err = $ptbroj_err = "";
        $slika_firstname = $slika_email = $slika_poruka = $slika_mjesto = $slika_ptbroj = $slika_emailpotvrda = "";
        $show_form = "";

            
            $validno = true;

            if ($firstname == "") 
            {
                $firstname_err = "Unesite ime i prezime";
                $slika_firstname = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
                if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) 
                {
                    $firstname_err = "Samo slova i razmaci su dozvoljeni"; 
                    $slika_firstname = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }
           
            if ($email == "") 
            {
                $email_err = "Unesite Email";
                $slika_email = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
                // provjerava je li unesen ispravan format emaila
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $email_err = "Neispravan format emaila"; 
                    $slika_email = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }

                // provjera potvrdnog emaila
                if ($emailpotvrda == "")
                {
                    $emailpotvrda_err = "Unesite potvrdni Email";
                    $slika_emailpotvrda = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
                else
                {
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


            if ($poruka == "") 
            {
                $poruka_err = "Napišite poruku";
                $slika_poruka = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                $validno = false;
            } 
            else 
            {
            }


            if ($mjesto != "") 
            {
                // provjera da li je mjesto ispravno uneseno
                if (!preg_match("/^[a-zA-Z ]*$/",$mjesto)) 
                {
                    $mjesto_err = "Samo slova i razmaci su dozvoljeni"; 
                    $slika_mjesto = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }

            if ($ptbroj != "") 
            {
                // provjera da li je ime ispravno uneseno
                if (!is_numeric($ptbroj)) 
                {
                    $ptbroj_err = "Samo brojevi su dozvoljeni"; 
                    $slika_ptbroj = '<img src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Danger.png" alt="greska" height="15" width="15">';
                    $validno = false;
                }
            }
    
        //if valid then redirect
        if($validno)
        {
            $request = '/Form_OK.php';
        }  
        else
        {
            $request = '/Form_NOT_OK.php';
        }      


}
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>