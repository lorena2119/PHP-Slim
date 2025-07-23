<?php

namespace App\UseCases;

use App\Domain\Repositories\CamperRepositoryInterface;

class GetAllCampers{
    public function __construct(private CamperRepositoryInterface $repo) {}
    
    public function execute():array{
        return $this->repo->getAll();
    }
}