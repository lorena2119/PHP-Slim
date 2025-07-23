<?php

namespace App\Infraestructure\Database;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection{
    public static function init(): string | bool{
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' =>  $_ENV['DB_PASS'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        try {
            Capsule::connection()->getPdo();
            return true;
        } catch (Exception $ex) {
            return "No se puede conectar con la base de datos: ".$ex->getMessage();
        }
    }
}