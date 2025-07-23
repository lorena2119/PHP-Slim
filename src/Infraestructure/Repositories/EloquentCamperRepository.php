<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

class EloquentCamperRepository implements CamperRepositoryInterface{
    public function getAll(): array{
        return Camper::all()->toArray();
    }
    public function getById(int $documento): ?Camper{
        return Camper::find($documento);
    }
    public function create(array $data): Camper{
        return Camper::create($data);
    }
    public function update(int $documento, array $data):bool{
        $camper = Camper::find($documento);
        return $camper ? $camper->update($data) : false;
    }
    public function delete(int $documento): bool{
        $camper = Camper::find($documento);
        return $camper ? $camper->delete() : false;
    }
}