<?php

namespace App\UseCases;

use App\Domain\Repositories\CamperRepositoryInterface;
class UpdateCamper{
    public function __construct(private CamperRepositoryInterface $repo) {}

    public function execute(int $documento, array $data): bool{
        return $this->repo->update($documento, $data);
    }
}