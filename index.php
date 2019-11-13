<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
session_start();

require_once('vendor/autoload.php');


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \model\Query;
use \model\User;
$app = AppFactory::create();

$app->get('/',function(Request $req, Response $res, array $args){

	$query = new Query();

	$query->setQuery("SELECT * FROM nome");
    $query->execQuery();


    $res->getBody()->write(json_encode($query->getResults()));

	return $res;
});


$app->get("/authentication",function (Request $req, Response $res, array  $args){

    $user = new User();

    $validUser = $user->identifyJWT("DW");

    if($validUser == false){
        $res->getHeader("404 NOT FOUND");
        $return = "Inválido";
    }else{
        $return = json_encode(array(
            "user_id"=>$validUser->user_id,
            "username"=>$validUser->username,
            "is_admin"=>$validUser->is_admin
        ));
    }

    $res->getBody()->write($return);

    return $res;
});

$app->post("/authentication",function (Request $req, Response $res, array  $args){

    $user = new User();

    $login = $user->login($_POST['email'],$_POST['password']);

    \persistence\Database::getEnvVariables();
    $jwt = $user->authenticateWithJWT(
        array(
            "iss" => getenv("ISS"),
            "aud" => getenv("AUD"),
            "iat" => time(),
            "exp" => time() + 3600,
            "user_id"=>$login['user_id'],
            "username"=>$login['username'],
            "is_admin"=>$login['is_admin']
        )
    );


    if($jwt != ""){
        $res->getHeader("200 OK");
        $res->getBody()->write("Autenticado");
    }

    setcookie("JWT_AUTH",$jwt,time() + 3600);

    var_dump($jwt);

    return $res;
});




$app->run();