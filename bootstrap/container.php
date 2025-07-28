<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Handler\CustomErrorHandler;
use App\Infraestructure\Repositories\EloquentCamperRepository;
use App\Infraestructure\Repositories\EloquentUserRepository;
use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

$container = new Container();

$container->set(CamperRepositoryInterface::class, function(){
    return new EloquentCamperRepository();
});

$container->set(UserRepositoryInterface::class, function(){
    return new EloquentUserRepository();
});

$container->set(ErrorHandlerInterface::class, function() use($container){
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});



return $container;