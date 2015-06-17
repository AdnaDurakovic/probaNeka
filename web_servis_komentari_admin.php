<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) 
{ 
    try
    {
        $request = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
    }
    catch(PDOException $e)
    {
        print $e;
    }
    $request->exec("set names utf8");

    $upit = $request->prepare("SELECT * FROM komentar ORDER BY datum DESC");
    $upit->execute();

    print "{ \"komentari\": " . json_encode($upit->fetchAll()) . "}";
}
function rest_post($request, $data)
{


}
function rest_delete($request) 
{
    $idkomentar = htmlentities($data['komentarid']);

    try
    {
        $request = new PDO("mysql:dbname=tut9;host=localhost;charset=utf8", "root", "root");
    }
    catch(PDOException $e)
    {
        print $e;
    }
    $request->exec("set names utf8");

    $upit = $request->prepare("DELETE FROM komentar WHERE id=?");
    $upit->bindValue(1, $idkomentar, PDO::PARAM_INT);
    $upit->execute();
}
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