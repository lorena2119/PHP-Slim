<?php

namespace App\Controllers;

use App\Domain\Repositories\CamperRepositoryInterface;
use App\UseCases\CreateCamper;
use App\UseCases\GetAllCampers;
use App\UseCases\GetCampersById;
use App\UseCases\UpdateCamper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CamperController{
    public function __construct(private CamperRepositoryInterface $repo) {}
    
    public function index(Request $request, Response $response): Response{
        $useCase = new GetAllCampers($this->repo);
        $camper = $useCase->execute();
        $response->getBody()->write(json_encode($camper));
        return $response;
    }
    public function show(Request $request, Response $response, array $args): Response{
        $useCase = new GetCampersById($this->repo);
        $camper = $useCase->execute((int)$args['documento']);
        if (!$camper) {
            $response->getBody()->write(json_encode(["error" => "Camper no encontrado"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($camper));
        return $response;
    }
    public function store(Request $request, Response $response): Response{
        $data = $request->getParsedBody();
        $useCase = new CreateCamper($this->repo);
        $camper = $useCase->execute($data);
        if (!$camper) {
            $response->getBody()->write(json_encode(["error" => "Camper no encontrado"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($camper));
        return $response->withStatus(201);
    }
    public function update(Request $request, Response $response, array $args): Response{
        $documento = (int)$args['documento'];
        $data = $request->getParsedBody();
        $useCase = new UpdateCamper($this->repo);
        $success = $useCase->execute($documento, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Camper no encontrado"]));
            return $response->withStatus(404);
        }
        return $response->withStatus(204);
    }
    public function delete(Request $request, Response $response): Response{
        return $response;
    }
}