<?php
require_once "vendor/autoload.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Factory\AppFactory;
use App\Middleware\JsonBodyParserMiddleware;

$app = AppFactory::create();

$app->get('/', function(Request $req, Response $res, array $args){
    $res->getBody()->write(json_encode(["message" => "Hola desde slim"]));
    return $res;
});

//Middleware
// Global -> todas las request del backend
$app->add(function(Request $req, Handler $han): Response{
    $response = $han->handle($req);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->add(new JsonBodyParserMiddleware());

// GET      /campers
// POST     /campers
// PUT      /campers/1
// PATCH    /campers/1
// DELETE   /campers/1

$app->get("/campers/{name}/{skill}", function(Request $req, Response $res, array $args){
    // GET localhost:8081/campers?name=Adrian&skill=php

    $name = $args["name"] ?? "default";
    $skill = $args["skill"] ?? "default";
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
})->add(function(Request $req, Handler $han): Response{
    $response = $han->handle($req);
    return $response->withHeader('X-Powered-By', 'Slim Framework');
});


$app->get("/campers", function(Request $req, Response $res, array $args){
    // GET localhost:8081/campers?name=Adrian&skill=php
    
    $params = $req->getQueryParams();
    $name = $params["name"] ?? "default";
    $skill = $params["skill"] ?? "default";
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
});

$app->post("/campers", function(Request $req, Response $res, array $args){
    $data = $req->getParsedBody();
    $res = $res->withStatus(201);
    $res->getBody()->write(json_encode($data));
    return $res;
});
$app->run();