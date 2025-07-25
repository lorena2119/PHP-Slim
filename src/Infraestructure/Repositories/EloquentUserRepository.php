<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use Exception;
use Slim\Psr7\Message;

class EloquentUserRepository implements UserRepositoryInterface{
    public function create(array $data): User{
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            throw new Exception('Error, el usuario ya existe');
        }

        return User::create($data);
    }
}