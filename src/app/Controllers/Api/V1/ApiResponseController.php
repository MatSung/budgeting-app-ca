<?php

namespace App\Controllers\Api\V1;

use DateTime;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

trait ApiResponseController
{
    protected function formatSuccessfulResponse(array|string $payload = 'No results'): array
    {
        $formattedResponse = [
            'status' => 'success',
            'results' => is_string($payload) ? [$payload] : $payload
        ];

        return $formattedResponse;
    }
}