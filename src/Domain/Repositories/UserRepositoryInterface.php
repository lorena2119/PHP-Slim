<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\DTOs\UserDTO;
interface UserRepositoryInterface{
    // public function getAll(): array;
    // public function getById(int $documento): ?Camper;
    public function create(UserDTO $dto): User;
    // public function update(int $documento, array $data):bool;
    // public function delete(int $documento): bool;
}