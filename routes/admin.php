<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \model\Query;
use \model\User;


$app->get('/',function(Request $req, Response $res, array $args){

    $query = new Query();

    $query->setQuery("SELECT * FROM nome");
    $query->execQuery();


    $res->getBody()->write(json_encode($query->getResults()));

    return $res;
});


$app->get("/authentication/{jwt}",function (Request $req, Response $res, array  $args){
    $jwt = base64_decode($req->getAttribute("jwt"));
    $user = new User();

    $validUser = $user->identifyJWT($jwt);

    if($validUser == false){
        $return = json_encode(array("login"=>"unauthorized"));
        $status = 401;
    }else{
        $return = json_encode(array(
            "user_id"=>$validUser->user_id,
            "username"=>$validUser->username,
            "is_admin"=>$validUser->is_admin
        ));
        $status = 200;
    }

    $res->getBody()->write($return);

    return $res->withStatus($status)->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET');;
});


$app->get("/authentication",function (Request $req, Response $res, array  $args){
    $jwt = base64_decode($_COOKIE['JWT_AUTH']);
    $user = new User();

    $validUser = $user->identifyJWT($jwt);

    if($validUser == false){
        $return = json_encode(array("login"=>"unauthorized"));
        $status = 401;
    }else{
        $return = json_encode(array(
            "user_id"=>$validUser->user_id,
            "username"=>$validUser->username,
            "is_admin"=>$validUser->is_admin
        ));
        $status = 200;
    }

    $res->getBody()->write($return);

    return $res->withStatus($status)->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET');;
});


$app->post("/authentication",function (Request $req, Response $res, array  $args){
    $user = new User();
    $login = $user->login($_POST['email'],$_POST['password']);

    if(is_array($login) && !empty($login)){
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
            $res->getBody()->write(json_encode($jwt));
        }

        setcookie("JWT_AUTH",$jwt,time() + 3600);
        $return = $res->withStatus(200)->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'POST');

    }else{
        $res->getBody()->write("Unauthorized");
        $return = $res->withStatus(401)->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'POST');
    }

    return $return;
});