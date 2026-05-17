<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$jsonResponse = function (Request $request, Response $response): Response {
    $payload = [
        'username' => 'test',
    ];

    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
};

$app->map(['GET', 'POST'], '/api/v1/auth/signup', $jsonResponse);
$app->map(['GET', 'POST'], '/api/v1/auth/sign-in', $jsonResponse);
$app->map(['GET', 'POST'], '/api/v1/account', $jsonResponse);

$app->run();
