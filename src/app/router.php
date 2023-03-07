<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

$app->get('/',function(Request $request, Response $response): Response
{
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/index.html'));

    return $response;
});