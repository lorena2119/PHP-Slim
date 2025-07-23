<?php

namespace App\Controllers;

use App\Domain\Repositories\CamperRepositoryInterface;
use App\UseCases\GetAllCampers;
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
    public function show(Request $request, Response $response): Response{
        return $response;
    }
    public function store(Request $request, Response $response): Response{
        return $response;
    }
    public function update(Request $request, Response $response): Response{
        return $response;
    }
    public function delete(Request $request, Response $response): Response{
        return $response;
    }
}