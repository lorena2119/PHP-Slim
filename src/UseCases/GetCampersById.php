<?php

namespace App\UseCases;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

class GetCampersById{
    public function __construct(private CamperRepositoryInterface $repo) {}

    public function execute(int $documento): ?Camper{
        return $this->repo->getById($documento);
    }
}