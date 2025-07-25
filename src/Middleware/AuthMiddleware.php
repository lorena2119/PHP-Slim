<?php

namespace App\Middleware;

use App\Domain\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware{
    public function __invoke(Request $request, Handler $handler): Response
    {
        $auth = $request->getHeaderLine('Authorization');

        if (!$auth || !str_starts_with($auth, 'Basic')) {
            return $this->unauthorized();
        }
        $decoded = base64_decode(substr($auth, 6));
        [$email, $password] = explode(':', $decoded); //adrian1gmail.com:7654

        // Cambiar al repositiorio encargado
        $user = User::where('email', $email)->first();

        // Validar contraseña
        if (!$user || !password_verify($password, $user->password)) {
            return $this->unauthorized();
        }

        $request = $request->withAttribute('user', $user);

        return $handler->handle($request);
    }

    private function unauthorized(): Response{
        $response = new SlimResponse();
        $response->getBody()->write(json_encode(['error' => 'No autorizado']));
        return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
    }
}