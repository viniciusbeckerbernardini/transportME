<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

session_start();
session_regenerate_id();

require_once('vendor/autoload.php');
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
$app = AppFactory::create();


require_once './routes/404.php';
require_once './routes/admin.php';
require_once './routes/api.php';



$app->run();