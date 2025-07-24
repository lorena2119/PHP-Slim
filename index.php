<?php

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

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

// Ejecutando scripts de public
(require_once 'public/index.php')($app);

// routes
(require_once 'routes/campers.php')($app);

$app->run();