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

$app->run();