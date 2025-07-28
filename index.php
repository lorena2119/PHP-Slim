<?php

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

// Variables de .env
$dotenv = Dotenv::createImmutable(__DIR__.'/');
$dotenv->load();

// Container, dr carga el container de PHP-DI
$container = require_once 'bootstrap/container.php';

// Asignamos a Slim el contenedor
AppFactory::setContainer($container);

//Iniciar la conexión de la DB
Connection::init();

$app = AppFactory::create();

// inyectamos ResponseFactory que necesita nuestro CustomErrorHandler
$container->set(ResponseFactoryInterface::class, $app->getResponseFactory());

// Definir quién va a manejar los errores
$errorHandler = $app->addErrorMiddleware(true, true, true);
$errorHandler->setDefaultErrorHandler($container->get(ErrorHandlerInterface::class));

// Ejecutando scripts de public
(require_once 'public/index.php')($app);

// routes
(require_once 'routes/campers.php')($app);
(require_once 'routes/user.php')($app);

$app->run();