<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) 
{ 
    $idvijesti = htmlentities($data['vijest']);

    try
    {
        $request = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
    }
    catch(PDOException $e)
    {
        print $e;
    }
    $request->exec("set names utf8");

    $upit = $request->prepare("SELECT * FROM komentar WHERE vijest=? ORDER BY datum DESC");
    $upit->bindValue(1, $idvijesti, PDO::PARAM_INT);
    $upit->execute();

    print "{ \"komentari\": " . json_encode($upit->fetchAll()) . "}";
}
function rest_post($request, $data)
{
    $autor = htmlentities($data['autor']);
    $tekst = htmlentities($data['tekst']);
    $vijestBr = htmlentities($data['vijest']);

    try
    {
        $request = new PDO("mysql:dbname=proba;host=127.8.163.2;charset=utf8", "adminhygNSs5", "UfXHKXHCqhEE");
    }
    catch(PDOException $e)
    {
        print $e;
    }
    $request->exec("set names utf8");

    $upit = $request->prepare("INSERT INTO komentar(autor,tekst,vijest) VALUES(:autor,:tekst,:vijestBr)");

    $upit->execute(array(':autor'=>$autor,
                         ':tekst'=>$tekst,
                         ':vijestBr'=>$vijestBr));

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