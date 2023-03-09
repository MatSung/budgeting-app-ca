<?php

namespace App\Controllers\Api\V1;

use DateTime;

use App\Repositories\BaseRepository;
use App\Controllers\Api\V1\ApiResponseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use RuntimeException;

class EntryController
{
    use ApiResponseController;

    const REQUIRED_FIELDS = ['dateTime', 'typeId', 'amount'];

    function __construct(private BaseRepository $entryRepository)
    {
    }

    public function index(Request $request, Response $response, $args = []): Response
    {
        $entries = $this->entryRepository->fetchAll();

        $payload = $this->formatSuccessfulResponse($entries);

        $payload = json_encode($payload);

        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type','application/json')->withStatus(201);
    }
}
