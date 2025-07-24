<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Infraestructure\Repositories\EloquentCamperRepository;
use DI\Container;

$container = new Container();

$container->set(CamperRepositoryInterface::class, function(){
    return new EloquentCamperRepository();
});

return $container;