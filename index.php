<?php 

session_start();

require_once('vendor/autoload.php');


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \model\Query;
$app = AppFactory::create();

$app->get('/',function(Request $req, Response $res, array $args){

	$query = new Query();

	$query->setQuery("SELECT * FROM nome");
    $query->execQuery();

    $res->getBody()->write(json_encode($query->getResults(),true));

	return $res;
});




$app->run();