<?php

namespace App\Controllers;
use App\Domain\Repositories\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DTOs\UserDTO;

class UserController{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function createUser(Request $request, Response $response): Response{
        // Se deben implementar los casos de uso
        $data = $request->getParsedBody();
        $dto = new UserDTO(
            nombre: $data['nombre'] ?? '',
            email: $data['correo'] ?? '',
            password: $data['contraseña'] ?? '',
            rol: 'user'
        );

        $user = $this->repo->create($dto);

        $response->getBody()->write(json_encode($user));
        return $response->withStatus(201);
    }

    public function createAdmin(Request $request, Response $response): Response{
        // Se deben implementar los casos de uso
        $data = $request->getParsedBody();
        $data['rol'] = 'admin';
        // DTO
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->repo->create($data);

        $response->getBody()->write(json_encode($user));
        return $response->withStatus(201);
    }
}