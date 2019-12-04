<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \model\Routes;


$app->get("/bus/get/all",function (Request $req, Response $res, array  $args){
    $return = Routes::getAllRoutes();
    $res->getBody()->write(json_encode($return));
    return $res->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get("/bus/get/{id}",function (Request $req, Response $res, array  $args){
    $id = $req->getAttribute("id");
    $return = Routes::getStopsByID($id);
    $res->getBody()->write(json_encode($return));
    return $res->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->post("/bus/create-route",function (Request $req, Response $res, array  $args){
    $routes = new Routes();
    $routes->setId($_POST['route_id']);
    $routes->setRoute($_POST['route_long_name']);
    $routes->createRoute();
    $return = "ok";
    $res->getBody()->write($return);
    return $res->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->post("/bus/update-route",function (Request $req, Response $res, array  $args){
    $routes = new Routes();
    $routes->setId($_POST['route_id']);
    $routes->setRoute($_POST['route_long_name']);
    $routes->updateRoute($_POST['route_old_id']);
    $return = "ok";
    $res->getBody()->write($return);
    return $res->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});