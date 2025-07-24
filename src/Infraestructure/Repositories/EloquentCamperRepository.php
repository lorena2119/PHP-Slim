<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

use function DI\get;

class EloquentCamperRepository implements CamperRepositoryInterface{
    public function getAll(): array{
        return Camper::all()->toArray();
    }
    public function getById(int $documento): ?Camper{
        return Camper::where('documento', $documento)->first();
    }
    public function create(array $data): Camper{
        $exists = $this->getById($data['documento']);
        if ($exists) {
            return $exists;
        }
        return Camper::create($data);
    }
    public function update(int $documento, array $data):bool{
        $camper = $this->getById($data['documento']);
        return $camper ? $camper->update($data) : false;
    }
    public function delete(int $documento): bool{
        $camper = Camper::find($documento);
        return $camper ? $camper->delete() : false;
    }
}