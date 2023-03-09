<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Api\V1\EntryController;

$app->get('/', function (Request $request, Response $response): Response {
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/index.html'));
    return $response;
});

$app->get('/dashboard', function (Request $request, Response $response): Response {
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/index.html'));
    return $response;
});

$app->get('/settings', function (Request $request, Response $response): Response {
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/settings.html'));
    return $response;
});

$app->get('/api/documentation', function (Request $request, Response $response): Response {
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/api/documentation.html'));

    return $response;
});

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    $group->group('/entries', function (RouteCollectorProxy $group) {
        $group->get('', [EntryController::class, 'index']);
        $group->get('/{entry}', [EntryController::class, 'find']);
        $group->post('', [EntryController::class, 'create']);
        $group->delete('/{entry}', [EntryController::class, 'delete']);
    });
});
