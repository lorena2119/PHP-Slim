<?php

namespace App\UseCases;

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Models\Camper;

class CreateCamper{
    public function __construct(private CamperRepositoryInterface $repo) {}

    public function execute(array $data): ?Camper{
        return $this->repo->create($data);
    }
}