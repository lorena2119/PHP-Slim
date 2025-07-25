<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infraestructure\Repositories\EloquentCamperRepository;
use App\Infraestructure\Repositories\EloquentUserRepository;
use DI\Container;

$container = new Container();

$container->set(CamperRepositoryInterface::class, function(){
    return new EloquentCamperRepository();
});

$container->set(UserRepositoryInterface::class, function(){
    return new EloquentUserRepository();
});


return $container;