<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;

interface UserRepositoryInterface{
    // public function getAll(): array;
    // public function getById(int $documento): ?Camper;
    public function create(array $data): User;
    // public function update(int $documento, array $data):bool;
    // public function delete(int $documento): bool;
}